<?php
// Placeholder credentials
$correct_username = "admin";
$correct_password = "password";

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Check credentials
if ($username === $correct_username && $password === $correct_password) {
    echo "Login successful! Welcome, " . htmlspecialchars($username) . ".";
} else {
    echo "Invalid username or password.";
}
?>
