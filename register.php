<?php
session_start();
require './config/config.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $username = htmlspecialchars($_POST['username']);
    $fullname = htmlspecialchars($_POST['fullname']);
    $gender = htmlspecialchars($_POST['gender']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $dob = htmlspecialchars($_POST['dob']);
    $country = htmlspecialchars($_POST['country']);
    $state = htmlspecialchars($_POST['state']);
    $university = htmlspecialchars($_POST['university']);
    $faculty = htmlspecialchars($_POST['faculty']);
    $department = htmlspecialchars($_POST['department']);
    $matricno = htmlspecialchars($_POST['matricno']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, fullname, gender, phone, email, dob, country, state, university, faculty, department, matricno, password) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$username, $fullname, $gender, $phone, $email, $dob, $country, $state, $university, $faculty, $department, $matricno, $password]);

        // Send confirmation email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'your_smtp_host';
        $mail->SMTPAuth = true;
        $mail->Username = 'your_smtp_username';
        $mail->Password = 'your_smtp_password';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('no-reply@infund.com', 'INFund');
        $mail->addAddress($email);
        $mail->Subject = 'Welcome to INFund';
        $mail->Body = "Thank you for signing up, $fullname!";

        if ($mail->send()) {
            echo "<script>toastr.success('Registration successful! Redirecting...', 'Success');</script>";
            header("refresh:3;url=index.php"); // Redirect after 3 seconds
        } else {
            echo "<script>toastr.error('Email could not be sent. Try again.', 'Error');</script>";
        }
    } catch (Exception $e) {
        echo "<script>toastr.error('Registration failed. Please try again.', 'Error');</script>";
    }
}
