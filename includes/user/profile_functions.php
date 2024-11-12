<?php

function getUserStats($user_id) {
    global $conn;
    
    $stats = array(
        'total_donations' => 0,
        'active_campaigns' => 0,
        'total_bills' => 0
    );
    
    // Get total donations made by user
    $query = "SELECT SUM(amount) as total_donations 
              FROM donations d 
              JOIN campaigns c ON d.campaign_id = c.id 
              WHERE c.uid = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()) {
        $stats['total_donations'] = $row['total_donations'] ?? 0;
    }
    
    // Get active campaigns count
    $query = "SELECT COUNT(*) as active_campaigns 
              FROM campaigns 
              WHERE uid = ? AND status = 'active'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()) {
        $stats['active_campaigns'] = $row['active_campaigns'];
    }
    
    // Get total bills count
    $query = "SELECT COUNT(*) as total_bills 
              FROM payments p 
              JOIN bills b ON p.bill_id = b.id 
              WHERE p.student_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()) {
        $stats['total_bills'] = $row['total_bills'];
    }
    
    return $stats;
}



function getUserData($user_id) {
    global $conn;
    
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_assoc();
}

function getBanks() {
    global $conn;
    
    $query = "SELECT * FROM banks ORDER BY BankName";
    $result = $conn->query($query);
    
    $banks = array();
    while ($row = $result->fetch_assoc()) {
        $banks[] = $row;
    }
    
    return $banks;
}

function isFieldUnique($field, $value, $user_id) {
    global $conn;
    
    $query = "SELECT id FROM users WHERE $field = ? AND id != ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $value, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->num_rows === 0;
}

function validateProfileData($data) {
    $errors = array();
    
    // Validate required fields
    $required_fields = array('fullname', 'username', 'email', 'phone', 'dob', 'gender', 
                           'country', 'state', 'level', 'bank_id', 'bank_account_name', 'account_number');
    
    foreach ($required_fields as $field) {
        if (empty($data[$field])) {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required';
        }
    }
    
    // Validate email format
    if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }
    
    // Validate phone number (basic validation)
    if (!empty($data['phone']) && !preg_match('/^[0-9]{11}$/', $data['phone'])) {
        $errors[] = 'Phone number must be 11 digits';
    }
    
    // Validate account number
    if (!empty($data['account_number']) && !preg_match('/^[0-9]{10}$/', $data['account_number'])) {
        $errors[] = 'Account number must be 10 digits';
    }
    
    // Validate level
    $valid_levels = range(100, 900, 100);
    if (!empty($data['level']) && !in_array($data['level'], $valid_levels)) {
        $errors[] = 'Invalid level selected';
    }
    
    return $errors;
}

function updateUserProfile($user_id, $data) {
    global $conn;
    
    // Validate data
    $validation_errors = validateProfileData($data);
    if (!empty($validation_errors)) {
        return array('success' => false, 'message' => implode(', ', $validation_errors));
    }
    
    try {
        // Start transaction
        $conn->begin_transaction();
        
        $query = "UPDATE users SET 
                  fullname = ?,
                  username = ?,
                  email = ?,
                  phone = ?,
                  dob = ?,
                  gender = ?,
                  country = ?,
                  state = ?,
                  level = ?,
                  bank_id = ?,
                  bank_account_name = ?,
                  account_number = ?,
                  updated_at = CURRENT_TIMESTAMP
                  WHERE id = ?";
                  
        $stmt = $conn->prepare($query);
        
        // Check if prepare failed
        if (!$stmt) {
            throw new Exception("Preparation failed: " . $conn->error);
        }
        
        $stmt->bind_param("ssssssssisssi",
            $data['fullname'],
            $data['username'],
            $data['email'],
            $data['phone'],
            $data['dob'],
            $data['gender'],
            $data['country'],
            $data['state'],
            $data['level'],
            $data['bank_id'],
            $data['bank_account_name'],
            $data['account_number'],
            $user_id
        );
        
        $stmt->execute();
        
        if ($stmt->affected_rows === 0 && $stmt->errno === 0) {
            // No changes were made but query was successful
            $conn->commit();
            return array('success' => true, 'message' => 'No changes were made to the profile');
        }
        
        if ($stmt->affected_rows > 0) {
            // Changes were made successfully
            $conn->commit();
            return array('success' => true, 'message' => 'Profile updated successfully');
        }
        
        // If we get here, something went wrong
        throw new Exception('Failed to update profile');
        
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        return array('success' => false, 'message' => 'Error updating profile: ' . $e->getMessage());
    }
}

function sanitizeInput($data) {
    $sanitized = array();
    foreach ($data as $key => $value) {
        // Remove whitespace
        $value = trim($value);
        
        // Convert special characters to HTML entities
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        
        $sanitized[$key] = $value;
    }
    return $sanitized;
}