<?php
session_start();

// Destroy the session.
session_destroy();

// Redirect to the logout confirmation page.
header("Location: logout.html");
exit();
?>
