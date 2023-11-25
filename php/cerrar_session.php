<?php
session_start();

// Set the inactivity timeout to 5 minutes
$inactive_timeout = 300; // 5 minutes in seconds

// Check if the session is not set or has expired
if (!isset($_SESSION['rol']) || (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive_timeout))) {
    // Destroy the session and redirect to the login page
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}

// Update the last activity timestamp
$_SESSION['last_activity'] = time();


// CODIGO

    session_start();
    session_destroy();
    header("location: ../index.php");
?>