<?php

// ============================================================
// CONTROLLER FILE — ContactController.php
// ============================================================
// The Controller is the middleman.
// It reads the form data, checks it is valid,
// tells the Model to save it, and sends back a JSON response.
// ============================================================

// Load the Model file so we can use the saveContact() function
require_once __DIR__ . '/../Models/ContactModel.php';

// This function handles the contact form submission
// It is called from public/index.php when the form is submitted
function handleContactForm($conn) {

    // Tell the browser: the response will be JSON, not HTML
    header('Content-Type: application/json');

    // ---- STEP 1: Read the form data from $_POST ----
    // $_POST holds the values the user typed in the form
    // trim() removes any extra spaces from the beginning and end
    // htmlspecialchars() converts dangerous characters like < > & to safe text
    // ?? '' means: if this field was not sent, use an empty string instead
    $name    = htmlspecialchars(trim($_POST['name']    ?? ''));
    $email   = htmlspecialchars(trim($_POST['email']   ?? ''));
    $mobile  = htmlspecialchars(trim($_POST['mobile']  ?? ''));
    $subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // ---- STEP 2: Validate the data ----
    // Make sure the required fields are not empty
    $errors = [];

    if (empty($name)) {
        $errors[] = 'Name is required.';
    }

    if (empty($email)) {
        $errors[] = 'Email is required.';
    }

    // filter_var checks if the email looks like a real email address
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    }

    if (empty($message)) {
        $errors[] = 'Message is required.';
    }

    // If there are any errors, send them back to the browser and stop here
    if (!empty($errors)) {
        http_response_code(422); // 422 means "the data you sent is invalid"
        echo json_encode([
            'status'  => 'error',
            'message' => implode(' ', $errors) // join all errors into one string
        ]);
        return;
    }

    // ---- STEP 3: Save to database ----
    // Put the clean data into an array and pass it to saveContact()
    $data = [
        'name'    => $name,
        'email'   => $email,
        'mobile'  => $mobile,
        'subject' => $subject,
        'message' => $message
    ];

    // Call the saveContact() function from ContactModel.php
    // It returns true if saved, false if something went wrong
    $saved = saveContact($data, $conn);

    if (!$saved) {
        http_response_code(500); // 500 means "something went wrong on the server"
        echo json_encode([
            'status'  => 'error',
            'message' => 'Failed to save your message. Please try again.'
        ]);
        return;
    }

    // ---- STEP 4: Send email notification ----
    // This sends you an email when someone fills the form
    // Note: mail() only works on a live server, not on localhost
    $to      = 'junayedrashid.dev@email.com'; // your email address
    $subject = !empty($subject) ? $subject : 'New Portfolio Contact';
    $headers = 'From: Portfolio Contact Form <no-reply@yourdomain.com>' . "\r\n" .
               'Reply-To: ' . $email . "\r\n" .
               'Content-Type: text/plain; charset=UTF-8';
    $body    = "New contact form submission\n"
             . "===========================\n"
             . 'Name:    ' . $name    . "\n"
             . 'Email:   ' . $email   . "\n"
             . 'Mobile:  ' . $mobile  . "\n"
             . 'Subject: ' . $subject . "\n\n"
             . "Message:\n" . $message;

    mail($to, $subject, $body, $headers);

    // ---- STEP 5: Send success response ----
    // Everything worked — tell the browser it was a success
    echo json_encode([
        'status'  => 'success',
        'message' => 'Message sent and saved successfully!'
    ]);
}
