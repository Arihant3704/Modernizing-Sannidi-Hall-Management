# Sannidi Hall Management System

A premium, modern web application for managing event hall bookings, built with PHP and MySQL. It features a stunning "glassmorphism" UI with deep charcoal and royal gold accents, delivering a "WOW" factor for both administrators and customers.

## Features

- **Unified Authentication:** A single secure login system for both `admin` and `user` roles using secure `password_hash` validation.
- **Premium User Dashboard:** Users can view hall availability, make reservation requests, and securely track the status of their bookings.
- **Premium Admin Dashboard:** Administrators have a centralized hub to review total statistics and individually Approve or Reject pending reservations.
- **Dynamic Gallery System:** Displays high-quality placeholders and imagery for luxurious corporate rooms, ballrooms, and garden view halls.
- **Responsive "Glassmorphism" UI:** A beautifully constructed custom CSS system dropping repetitive Bootstrap blocks in favor of high-end aesthetics.

## Project Structure

The codebase is organized in a professional, MVC-inspired directory layout:

- `assets/` - Contains static styling (`css/index.css`) and high-quality premium event `images/`.
- `admin/` - Administrator tools (`admin_dashboard.php` and `view_booking.php`).
- `user/` - Consumer portal workflow endpoints (`user_dashboard.php`, `book_hall.php`, `booking_history.php`).
- `includes/` - Secure shared backend logic, session management, and `db.php`.
- `database/` - Stores the initial `schema.sql`.
- **Root Files** - Public-facing points of entry like `index.php`, `login.php`, `register.php`, `gallery.php`, and `about.php`.

## Installation & Setup

1. **Database Configuration**
   - Ensure your MySQL server is active.
   - Create a database named `sannidi_hall`.
   - Import the schema from the `database/` folder:
     ```bash
     mysql -u root -p sannidi_hall < database/schema.sql
     ```
   - *Note: Your database connection settings are located in `includes/db.php`. Update `$user` and `$password` there if required.*

2. **Run the Application**
   - You can serve this project using Apache/Nginx (like XAMPP) or simply use PHP's built-in development server.
   - Using the provided start script:
     ```bash
     ./start.sh
     ```
   - Navigate to `http://localhost:8000` in your browser.
