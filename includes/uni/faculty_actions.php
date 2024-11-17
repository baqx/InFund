<?php
session_start();
require_once '../../config/config.php';

if (!isset($_SESSION['university_id'])) {
    die(json_encode(['success' => false, 'message' => 'Unauthorized']));
}

$university_id = $_SESSION['university_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['action'] === 'list') {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'created_at';
        $order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

        $allowed_sorts = ['name', 'created_at'];
        $allowed_orders = ['ASC', 'DESC'];

        if (!in_array($sort, $allowed_sorts)) $sort = 'created_at';
        if (!in_array($order, $allowed_orders)) $order = 'DESC';

        $count_stmt = $conn->prepare("SELECT COUNT(*) FROM university_faculties WHERE university_id = ?");
        $count_stmt->bind_param("i", $university_id);
        $count_stmt->execute();
        $total_records = $count_stmt->get_result()->fetch_row()[0];

        $sql = "SELECT * FROM university_faculties WHERE university_id = ? ORDER BY $sort $order LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $university_id, $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();

        $faculties = [];
        while ($row = $result->fetch_assoc()) {
            $faculties[] = $row;
        }

        echo json_encode([
            'success' => true,
            'faculties' => $faculties,
            'total_pages' => ceil($total_records / $limit)
        ]);
    } elseif ($_GET['action'] === 'departments') {
        $faculty_id = (int)$_GET['faculty_id'];

        $verify_stmt = $conn->prepare("SELECT id FROM university_faculties WHERE id = ? AND university_id = ?");
        $verify_stmt->bind_param("ii", $faculty_id, $university_id);
        $verify_stmt->execute();
        if ($verify_stmt->get_result()->num_rows === 0) {
            die(json_encode(['success' => false, 'message' => 'Invalid faculty']));
        }

        $stmt = $conn->prepare("SELECT * FROM university_departments WHERE university_id = ? AND faculty_id = ?");
        $stmt->bind_param("ii", $university_id, $faculty_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $departments = [];
        while ($row = $result->fetch_assoc()) {
            $departments[] = $row;
        }

        echo json_encode([
            'success' => true,
            'departments' => $departments
        ]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'add') {
        $name = trim($_POST['name']);

        if (empty($name)) {
            die(json_encode(['success' => false, 'message' => 'Faculty name is required']));
        }

        $check_stmt = $conn->prepare("SELECT id FROM university_faculties WHERE university_id = ? AND name = ?");
        $check_stmt->bind_param("is", $university_id, $name);
        $check_stmt->execute();

        if ($check_stmt->get_result()->num_rows > 0) {
            die(json_encode(['success' => false, 'message' => 'Faculty already exists']));
        }

        $uni_stmt = $conn->prepare("SELECT name FROM universities WHERE id = ?");
        $uni_stmt->bind_param("i", $university_id);
        $uni_stmt->execute();
        $university_name = $uni_stmt->get_result()->fetch_assoc()['name'];

        $stmt = $conn->prepare("INSERT INTO university_faculties (university_id, university, name) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $university_id, $university_name, $name);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error adding faculty']);
        }
    } elseif ($_POST['action'] === 'delete') {
        $faculty_id = (int)$_POST['faculty_id'];

        $conn->begin_transaction();

        try {
            $verify_stmt = $conn->prepare("SELECT id FROM university_faculties WHERE id = ? AND university_id = ?");
            $verify_stmt->bind_param("ii", $faculty_id, $university_id);
            $verify_stmt->execute();

            if ($verify_stmt->get_result()->num_rows === 0) {
                throw new Exception('Invalid faculty');
            }

            $dept_stmt = $conn->prepare("DELETE FROM university_departments WHERE faculty_id = ? AND university_id = ?");
            $dept_stmt->bind_param("ii", $faculty_id, $university_id);
            $dept_stmt->execute();

            $stmt = $conn->prepare("DELETE FROM university_faculties WHERE id = ? AND university_id = ?");
            $stmt->bind_param("ii", $faculty_id, $university_id);

            if (!$stmt->execute()) {
                throw new Exception('Error deleting faculty');
            }

            $conn->commit();
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            $conn->rollback();
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    } elseif ($_POST['action'] === 'add_department') {
        $faculty_id = (int)$_POST['faculty_id'];
        $name = trim($_POST['name']);

        if (empty($name)) {
            die(json_encode(['success' => false, 'message' => 'Department name is required']));
        }

        $verify_stmt = $conn->prepare("SELECT id FROM university_faculties WHERE id = ? AND university_id = ?");
        $verify_stmt->bind_param("ii", $faculty_id, $university_id);
        $verify_stmt->execute();

        if ($verify_stmt->get_result()->num_rows === 0) {
            die(json_encode(['success' => false, 'message' => 'Invalid faculty']));
        }

        $check_stmt = $conn->prepare("SELECT id FROM university_departments WHERE university_id = ? AND faculty_id = ? AND name = ?");
        $check_stmt->bind_param("iis", $university_id, $faculty_id, $name);
        $check_stmt->execute();

        if ($check_stmt->get_result()->num_rows > 0) {
            die(json_encode(['success' => false, 'message' => 'Department already exists in this faculty']));
        }

        $uni_stmt = $conn->prepare("SELECT name FROM universities WHERE id = ?");
        $uni_stmt->bind_param("i", $university_id);
        $uni_stmt->execute();
        $university_name = $uni_stmt->get_result()->fetch_assoc()['abbreviation'];

        $stmt = $conn->prepare("INSERT INTO university_departments (university_id, university, faculty_id, name) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isis", $university_id, $university_name, $faculty_id, $name);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error adding department']);
        }
    } elseif ($_POST['action'] === 'delete_department') {
        $department_id = (int)$_POST['department_id'];

        $verify_stmt = $conn->prepare("SELECT id FROM university_departments WHERE id = ? AND university_id = ?");
        $verify_stmt->bind_param("ii", $department_id, $university_id);
        $verify_stmt->execute();
        if ($verify_stmt->get_result()->num_rows === 0) {
            die(json_encode(['success' => false, 'message' => 'Invalid department']));
        }

        $stmt = $conn->prepare("DELETE FROM university_departments WHERE id = ? AND university_id = ?");
        $stmt->bind_param("ii", $department_id, $university_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error deleting department']);
        }
    }
}

$conn->close();
