<?php
/**
 * Logout - Clear session and redirect
 */

require_once __DIR__ . '/../config/Security.php';

Security::startSecureSession();

// Destroy session
session_destroy();

// Redirect to login
header('Location: login.php');
exit;
?>