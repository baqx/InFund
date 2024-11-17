<?php
session_start();
include '../../config/config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    die(json_encode(['success' => false, 'message' => 'User not authenticated']));
}

// API Configuration
$url = "https://openrouter.ai/api/v1/chat/completions";
$keyIndex = 0;
$OPENROUTER_API_KEY_1 = "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";
$OPENROUTER_API_KEY_2 = "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";
$OPENROUTER_API_KEY = $OPENROUTER_API_KEY_2;

// Validate form data
$errors = [];

// Required fields validation
$required_fields = ['title', 'description', 'goalAmount', 'startDate', 'endDate'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        $errors[] = ucfirst($field) . " is required";
    }
}

// Word count validation for impact and importance
if (!empty($_POST['impact']) && strlen($_POST['impact']) < 250) {
    $errors[] = "Impact must be at least 250 words";
}

if (!empty($_POST['importance']) && strlen($_POST['importance']) < 250) {
    $errors[] = "Importance must be at least 250 words";
}

// Date validation
$start_date = strtotime($_POST['startDate']);
$end_date = strtotime($_POST['endDate']);
$today = strtotime(date('Y-m-d'));

if ($start_date < $today) {
    $errors[] = "Start date cannot be in the past";
}

if ($end_date <= $start_date) {
    $errors[] = "End date must be after start date";
}

// Goal amount validation
if (!is_numeric($_POST['goalAmount']) || $_POST['goalAmount'] < 1000) {
    $errors[] = "Goal amount must be at least ₦1,000";
}

// Image validation and upload function
function handleImageUpload($file, $index)
{
    if (empty($file['name'])) {
        return $index === 1 ? false : null;
    }

    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowed_types)) {
        return false;
    }

    $max_size = 5 * 1024 * 1024; // 5MB
    if ($file['size'] > $max_size) {
        return false;
    }

    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $new_filename = uniqid('campaign_' . time() . '_') . '.' . $file_extension;
    $upload_path = '../../assets/images/campaigns/' . $new_filename;

    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        return $new_filename;
    }

    return false;
}

// Handle image uploads
$image1 = handleImageUpload($_FILES['image1'], 1);
if ($image1 === false) {
    $errors[] = "Primary image is required and must be a valid image file (JPG, PNG, or GIF) under 5MB";
}

$image2 = isset($_FILES['image2']) ? handleImageUpload($_FILES['image2'], 2) : null;
$image3 = isset($_FILES['image3']) ? handleImageUpload($_FILES['image3'], 3) : null;
$image4 = isset($_FILES['image4']) ? handleImageUpload($_FILES['image4'], 4) : null;

if (!empty($errors)) {
    die(json_encode(['success' => false, 'message' => implode("<br>", $errors)]));
}

// Spam Check Functions
function makePostRequest($url, $data, $headers = []) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if(curl_errno($ch)){
        curl_close($ch);
        return null;
    }
    curl_close($ch);

    return json_decode($response, true);
}

function switchApiKey(&$currentKeyIndex) {
    global $OPENROUTER_API_KEY_1, $OPENROUTER_API_KEY_2, $OPENROUTER_API_KEY;
    $currentKeyIndex = ($currentKeyIndex + 1) % 2;
    $OPENROUTER_API_KEY = ($currentKeyIndex == 0) ? $OPENROUTER_API_KEY_1 : $OPENROUTER_API_KEY_2;
}

function checkSpamLevel($description, $impact, $importance) {
    global $url, $OPENROUTER_API_KEY, $keyIndex;

    $promptContent = "PROMPT: " . $description . "\n" . $impact . "\n" . $importance;
    
    $criteria = "A campaign is a means for crowdfunding for ONLY university educational purposes. 

    Evaluate using these key indicators:

    Likely_Genuine Indicators:
    - Clear, detailed description of educational purpose(classify as likely_spam if vague, unclear or missing)
    - Said purpose must actually be educational in nature
    - Specific breakdown of how funds will be used for said educational purpose(classify as likely_spam if vague, unclear or missing)

    Likely_Spam Indicators:
    - Has no clear educational purpose
    - Vague or generic educational purpose
    - Overly emotional or manipulative language
    - Lack of specific fund allocation details(this is of extreme importance)
    - Threatening message or tone

    Likely_Unsure Indicators:
    - Partially incomplete information
    - Some details present but lacking full clarity
    - Moderate inconsistencies in the description
    - Requires additional verification

    If your classification is 'likely_genuine' then let your only response strictly be likely_genuine.
    If your classification is 'likely_spam' then let your only response strictly be likely_spam.
    If your classification is 'likely_unsure' then let your only response strictly be likely_unsure.";

    $headers = [
        "Authorization: Bearer " . $OPENROUTER_API_KEY,
        "Content-Type: application/json"
    ];

    $data = [
        "model" => "nousresearch/hermes-3-llama-3.1-405b:free",
        "messages" => [
            [
                "role" => "user",
                "content" => $promptContent . $criteria
            ]
        ]
    ];

    $spamCount = 0;
    $genuineCount = 0;
    $unsureCount = 0;
    
    // Test API connection
    $standardData = [
        "model" => "nousresearch/hermes-3-llama-3.1-405b:free",
        "messages" => [
            [
                "role" => "user",
                "content" => "Hello"
            ]
        ]
    ];

    $isWorking = false;
    for($retries = 0; $retries < 4; $retries++) {
        $standardResponseData = makePostRequest($url, $standardData, $headers);
        if (isset($standardResponseData['choices'])) {
            $isWorking = true;
            break;
        }
        switchApiKey($keyIndex);
    }

    if (!$isWorking) {
        return null;
    }

    // Perform spam check
    for ($i = 0; $i < 5; $i++) {
        $responseData = makePostRequest($url, $data, $headers);
        if (!isset($responseData['choices'][0]['message']['content'])) {
            continue;
        }

        $assistantResponse = $responseData['choices'][0]['message']['content'];
        switch ($assistantResponse) {
            case 'likely_spam':
                $spamCount++;
                break;
            case 'likely_genuine':
                $genuineCount++;
                break;
            case 'likely_unsure':
                $unsureCount++;
                break;
        }
        sleep(2);
    }

    $totalCount = $genuineCount + $spamCount + $unsureCount;
    if ($totalCount == 0) {
        return null;
    }

    $percentSpam = ($spamCount / $totalCount) * 100;
    return round($percentSpam, 2);
}

// Check spam level
$spam_level = checkSpamLevel($_POST['description'], $_POST['impact'], $_POST['importance']);

// Prepare and execute SQL with spam_level
$sql = "INSERT INTO campaigns (title, description, impact, importance, uid, goal_amount, 
        start_date, end_date, image1, image2, image3, image4, spam_level) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssidssssssd",
    $_POST['title'],
    $_POST['description'],
    $_POST['impact'],
    $_POST['importance'],
    $_SESSION['user_id'],
    $_POST['goalAmount'],
    $_POST['startDate'],
    $_POST['endDate'],
    $image1,
    $image2,
    $image3,
    $image4,
    $spam_level
);

if ($stmt->execute()) {
    $campaign_id = $conn->insert_id;
    echo json_encode([
        'success' => true,
        'message' => 'Campaign created successfully!',
        'campaign_id' => $campaign_id
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error creating campaign: ' . $conn->error
    ]);
}

$stmt->close();
$conn->close();