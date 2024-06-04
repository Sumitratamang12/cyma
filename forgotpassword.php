<?php
// Include database connection file
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(50));
        $stmt->close();

        // Insert token into database with an expiration date
        $stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $stmt->bind_param("sss", $email, $token, $expires_at);
        $stmt->execute();
        $stmt->close();

        // Send email with reset link
        $resetLink = "http://yourwebsite.com/reset_password.php?token=$token";
        $subject = "Password Reset Request";
        $message = "Click on the following link to reset your password: $resetLink";
        $headers = "From: no-reply@yourwebsite.com\r\n";

        if (mail($email, $subject, $message, $headers)) {
            echo "A password reset link has been sent to your email address.";
        } else {
            echo "Failed to send the reset email. Please try again.";
        }
    } else {
        echo "No account found with that email address.";
    }
}
?>
