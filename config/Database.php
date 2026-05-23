<?php

// ============================================================
// DATABASE CONNECTION FILE
// ============================================================
// This file connects to the MySQL database.
// It is included in other files that need to use the database.
// ============================================================

// Your database settings — change these to match your XAMPP setup
$db_host = 'localhost';     // always 'localhost' when using XAMPP
$db_user = 'root';          // default XAMPP username is 'root'
$db_pass = '';              // default XAMPP password is empty (no password)
$db_name = 'portfolio_db';  // the name of the database you created in phpMyAdmin

// Connect to MySQL using the settings above
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check if the connection worked
// mysqli_connect_error() returns an error message if something went wrong
if (mysqli_connect_error()) {
    // Stop the page and show an error message in JSON format
    http_response_code(500);
    die(json_encode([
        'status'  => 'error',
        'message' => 'Database connection failed: ' . mysqli_connect_error()
    ]));
}

// Set the character encoding to utf8mb4
// This makes sure special characters (like Bengali, Arabic, emojis) are stored correctly
mysqli_set_charset($conn, 'utf8mb4');
