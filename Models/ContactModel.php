<?php

// ============================================================
// MODEL FILE — ContactModel.php
// ============================================================
// The Model's only job is to save data to the database.
// It does not handle form input or send emails.
// ============================================================

// Note: Database.php is loaded by public/index.php before this file is used
// So $conn is already available when saveContact() is called

// This function saves one contact form submission into the database.
// $data   = an array containing: name, email, mobile, subject, message
// $conn   = the database connection from Database.php
// Returns true if saved successfully, false if it failed
function saveContact($data, $conn) {

    // Prepare a safe SQL INSERT query
    // The question marks (?) are placeholders — we fill them in below
    // Using placeholders prevents SQL Injection attacks
    $stmt = mysqli_prepare($conn,
        'INSERT INTO contacts (name, email, mobile, subject, message)
         VALUES (?, ?, ?, ?, ?)'
    );

    // Attach the real values to the placeholders
    // 'sssss' means all 5 values are strings (s = string, i = integer, d = decimal)
    mysqli_stmt_bind_param(
        $stmt,
        'sssss',
        $data['name'],
        $data['email'],
        $data['mobile'],
        $data['subject'],
        $data['message']
    );

    // Run the query — returns true if it worked, false if it failed
    $result = mysqli_stmt_execute($stmt);

    // Close the statement to free memory
    mysqli_stmt_close($stmt);

    // Return true or false so the controller knows if it worked
    return $result;
}
