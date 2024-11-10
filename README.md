NewsApp is a news platform built with CodeIgniter 3 and PHP 8.0, designed to keep users informed with news from 10 different categories and a custom search feature. This app provides secure user registration, login, and messaging capabilities. Admins have enhanced control over user activity, allowing them to monitor and manage users and messages efficiently. The app boasts a clean, modular structure and a dark mode interface for user convenience.

Features

User Features
User Registration & Login: Allows users to register and securely log in to access all features.
Live News Feed: Fetches news in real-time using the NewsData API and offers 10 curated categories for personalized content.
Search Functionality: Users can search news articles based on keywords.
Dark Mode: Provides a dark theme for a comfortable reading experience.
AJAX Forms: Forms are submitted asynchronously for a seamless user experience without page reloads.

Admin Features
User Management: Admins can monitor, edit, and delete user accounts.
Message Monitoring: Enables admins to track and manage user messages, ensuring a safe environment.

Security
Password Hashing: User passwords are securely hashed to protect sensitive information.

Scalable & Modular Design
Main Template Inheritance: All views inherit from a single main template, promoting clean and reusable code with each page containing only its unique HTML.
Dockerized Setup: Includes Docker support for simplified development and deployment, ensuring consistent environments.

Technology Stack
Backend: CodeIgniter 3, PHP 8.0
Frontend: Bootstrap 5
Database: MySQL 5.7
Server: Apache 2.4.56
Containerization: Docker

Installation
Prerequisites
Docker & Docker Compose

Steps
Run the Docker containers:
docker-compose up -d

Access the app at http://localhost

License
This project is licensed under the MIT License.
