<?php
include './includes/signup_functions.php';
$email = 'baqeecodes@gmail.com'; // Replace with the recipient's email
$fullname = 'John Doe'; // Replace with the recipient's full name

$result = sendWelcomeEmail($email, $fullname);

if ($result) {
    echo "Welcome email sent successfully!";
} else {
    echo "Failed to send welcome email.";
}
