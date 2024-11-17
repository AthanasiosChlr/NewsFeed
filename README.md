NewsApp is a news platform built with CodeIgniter 3 and PHP 8.0, designed to keep users informed with news from 10 different categories and a custom search feature. This app provides secure user registration, login, and messaging capabilities. Admins have enhanced control over user activity, allowing them to monitor and manage users and messages efficiently. The app boasts a clean, modular structure and a dark mode interface for user convenience.

You can try out the live version of the app at [NewsApp Live](https://newsfeed-production.up.railway.app/)

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

- Docker & Docker Compose
- Create a `.env` file with the following variables:
  ```
  NEWS_API_KEY=your_news_data_api_key
  MYSQL_HOST=your_mysql_host
  MYSQL_USER=your_mysql_user
  MYSQL_PASS=your_mysql_password
  MYSQL_DB=your_mysql_database
  MYSQL_PORT=your_mysql_port
  SMTP_HOST=your_smtp_host
  SMTP_PORT=your_smtp_port
  SMTP_USER=your_smtp_user
  SMTP_PASS=your_smtp_password
  ```

Steps

1. Clone the repository:
   ```
   git clone https://github.com/AthanasiosChlr/NewsFeed.git
   ```
2. Navigate to the project directory:
   ```
   cd newsfeed
   ```
3. Build the Docker containers:
   ```
   docker-compose build
   ```
4. Run the Docker containers:
   `     docker-compose up -d
    `
   Access the app at [http://localhost](http://localhost)

License
This project is licensed under the MIT License.
