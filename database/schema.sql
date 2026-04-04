-- Sannidi Hall Management System - Database Schema

CREATE DATABASE IF NOT EXISTS sannidi_hall;
USE sannidi_hall;

-- Users Table (Unified Admin and Customer)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    mob VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Halls Table
CREATE TABLE IF NOT EXISTS halls (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hall_name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    capacity INT DEFAULT 100,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image_url VARCHAR(255) DEFAULT 'default_hall.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Booking Table
CREATE TABLE IF NOT EXISTS booking (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    hall_id INT NOT NULL,
    booking_date DATE NOT NULL,
    start_time TIME DEFAULT NULL,
    end_time TIME DEFAULT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (hall_id) REFERENCES halls(id) ON DELETE CASCADE
);

-- Initial Admin Account (Password: Admin@123)
-- The hash below equates to Admin@123
INSERT IGNORE INTO users (user_name, email, mob, password, role) VALUES 
('System Admin', 'admin@sannidi.com', '9999999999', '$2y$10$Rz4/5o0sD3g2W13Xz9x9v.C28zSZZj.dKVh2QhZ2yB/wR/v1zF3eG', 'admin');

-- Sample Halls
INSERT INTO halls (hall_name, location, capacity, price, description) VALUES 
('Grand Ballroom', 'Main Wing', 500, 25000.00, 'A luxurious ballroom for large events.'),
('Small Meeting Hall', 'East Wing', 50, 5000.00, 'Perfect for corporate meetings and small gatherings.'),
('Garden View Hall', 'South Wing', 200, 15000.00, 'Beautiful views of the property gardens.');
