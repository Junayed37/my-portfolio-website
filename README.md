# 💼 Junayed Rashid — Personal Portfolio Website

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![XAMPP](https://img.shields.io/badge/XAMPP-Local%20Server-FB7A24?style=for-the-badge&logo=xampp&logoColor=white)
![MVC](https://img.shields.io/badge/Architecture-MVC-00C853?style=for-the-badge)

---

## 📌 Introduction

This is my **personal portfolio website** — a project I built to present myself as a developer and to practice building a real-world web application from scratch.

The frontend is fully animated and responsive, built with pure HTML, CSS, and JavaScript. The backend is written in PHP following the **MVC (Model-View-Controller)** architecture, which keeps the code organized and easy to understand.

The highlight of the project is the **contact form** — when a visitor sends a message, it gets validated on the server, saved to a **MySQL database**, and triggers an **email notification** — all without reloading the page thanks to AJAX.

---

## 🛠️ Technologies Used

| Layer        | Technology                        |
|--------------|-----------------------------------|
| Frontend     | HTML5, CSS3, JavaScript (ES6)     |
| Backend      | PHP 8 (Procedural MVC)            |
| Database     | MySQL via MySQLi                  |
| Local Server | XAMPP (Apache + MySQL + PHP)      |
| Icons        | Boxicons                          |
| Fonts        | Google Fonts — Poppins            |
| Animations   | Pure CSS keyframe animations      |

---

## ✨ Features

- **Animated responsive UI** — smooth section animations on scroll and page load
- **MVC architecture** — clean separation between data, logic, and presentation
- **Contact form** — validated on the server before anything is saved
- **MySQL integration** — every form submission is stored in the database
- **Email notification** — get notified by email when someone contacts you
- **AJAX submission** — the form submits without refreshing the page
- **Security** — XSS protection with `htmlspecialchars()` and SQL injection prevention with prepared statements

---

## 🏗️ How I Built It

I started with a plain HTML/CSS/JS frontend. Once the design was complete, I added a PHP backend step by step:

1. **Frontend first** — built the full portfolio layout in HTML and CSS with scroll animations, a sticky navbar, and a responsive design.

2. **Added the contact form** — created the HTML form fields and wired up JavaScript `fetch()` to submit the form asynchronously (AJAX), so the page never reloads.

3. **Built the PHP backend** — wrote the server-side logic to receive the form data, clean it, validate it, and return a JSON response to the browser.

4. **Connected the database** — set up a MySQL database in XAMPP, created a `contacts` table, and wrote a PHP function using prepared statements to safely insert the form data.

5. **Structured into MVC** — refactored the code into three layers:
   - **Model** (`ContactModel.php`) — talks to the database
   - **View** (`home.php`) — the HTML page
   - **Controller** (`ContactController.php`) — handles validation and ties everything together

6. **Added a front controller** — created `public/index.php` as the single entry point, which routes requests to the right place based on the URL.

---

## 🚀 How to Run the Project

### Requirements
- [XAMPP](https://www.apachefriends.org/) with **Apache** and **MySQL** running

### Steps

**1. Clone the repository** into your XAMPP `htdocs` folder:
```bash
git clone https://github.com/YOUR_USERNAME/my-portfolio-website.git "My Portfolio Website"
```

**2. Import the database:**
- Open `http://localhost/phpmyadmin`
- Click **Import** → select the `database.sql` file → click **Go**

**3. Open the site in your browser:**
```
http://localhost/My%20Portfolio%20Website/public/index.php
```

> The contact form saves to the database on localhost. Email sending only works on a live hosting server.

---

## 💡 How It Can Be Improved

There are several ways this project could be taken further:

- **Add more pages** — a dedicated projects page, blog, or certificates section
- **Admin dashboard** — a password-protected page to view all contact form submissions from the browser instead of checking phpMyAdmin
- **Use a PHP framework** — rewrite using Laravel or Slim for better routing, templating, and security out of the box
- **Add a CAPTCHA** — prevent spam submissions on the contact form (e.g. Google reCAPTCHA)
- **Deploy to a live server** — host on a service like Hostinger, Railway, or a VPS so it is accessible on the internet and email sending works
- **Use environment variables** — store database credentials in a `.env` file instead of hardcoding them, which is safer and more professional
- **Add dark/light mode toggle** — let visitors switch themes

---
