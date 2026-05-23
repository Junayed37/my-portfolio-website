-- ============================================================
-- DATABASE SETUP FILE — database.sql
-- ============================================================
-- How to use this file:
--   1. Open XAMPP and start Apache + MySQL
--   2. Go to http://localhost/phpmyadmin
--   3. Click "Import" in the top menu
--   4. Choose this file and click "Go"
-- That's it! The database and table will be created automatically.
-- ============================================================


-- Step 1: Create the database (if it doesn't already exist)
CREATE DATABASE IF NOT EXISTS portfolio_db;

-- Step 2: Select the database to use
USE portfolio_db;

-- Step 3: Create the contacts table
-- This table stores every message submitted through the contact form
CREATE TABLE IF NOT EXISTS contacts (

    -- Auto-incrementing ID — each row gets a unique number automatically
    id         INT AUTO_INCREMENT PRIMARY KEY,

    -- The name the visitor typed in the form
    name       VARCHAR(100)  NOT NULL,

    -- The email address of the visitor
    email      VARCHAR(150)  NOT NULL,

    -- The mobile number (optional, so it can be empty)
    mobile     VARCHAR(20)   DEFAULT '',

    -- The subject of the message (optional)
    subject    VARCHAR(200)  DEFAULT '',

    -- The actual message text
    message    TEXT          NOT NULL,

    -- The date and time the message was submitted
    -- CURRENT_TIMESTAMP fills this in automatically
    created_at TIMESTAMP     DEFAULT CURRENT_TIMESTAMP

);
