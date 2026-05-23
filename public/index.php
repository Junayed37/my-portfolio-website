<?php

// ============================================================
// FRONT CONTROLLER — public/index.php
// ============================================================
// This is the ONLY file the browser talks to directly.
// Every request comes here first, and this file decides
// what to do based on what the user is requesting.
// ============================================================

// BASE_PATH = the full path to the project's root folder on your computer
// dirname(__DIR__) means: go one folder up from where THIS file is
// Example: E:/XAMPP/htdocs/My Portfolio Website
define('BASE_PATH', dirname(__DIR__));

// Figure out if the site is using http or https
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';

// Get the domain name — e.g. "localhost"
$host = $_SERVER['HTTP_HOST'];

// Get the folder path of this file — e.g. "/My Portfolio Website/public"
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

// BASE_URL = the full web address to the public/ folder
// Example: http://localhost/My Portfolio Website/public
// We use this in the View to make correct links to CSS, JS, and images
define('BASE_URL', $scheme . '://' . $host . $base);

// Load the Controller file
// This gives us the handleContactForm() function
require_once BASE_PATH . '/Controllers/ContactController.php';

// $conn is created inside ContactModel.php (which is loaded by the Controller)
// We need it here to pass to the controller function

// Check what "action" was sent in the URL
// Example: index.php?action=contact
// If no action is given, use an empty string as the default
$action = $_GET['action'] ?? '';

// Check the HTTP method: GET means someone opened the page, POST means they submitted a form
$method = $_SERVER['REQUEST_METHOD'];

// ---- ROUTING ----
// Decide what to do based on the action and method

if ($action === 'contact' && $method === 'POST') {

    // The contact form was submitted
    // Load the database connection first, then handle the form
    require_once BASE_PATH . '/config/Database.php'; // this creates $conn
    handleContactForm($conn); // defined in Controllers/ContactController.php

} else {

    // No special action — just show the homepage
    require BASE_PATH . '/Views/home.php';

}
