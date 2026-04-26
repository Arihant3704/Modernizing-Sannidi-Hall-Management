#!/bin/bash

echo "=========================================="
echo " Starting Sannidi Hall Management System"
echo "=========================================="
echo ""

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "[ERROR] PHP could not be found. Please install PHP to run this application."
    exit 1
fi

# Check for mysqli extension
if ! php -m | grep -q mysqli; then
    echo "[ERROR] PHP 'mysqli' extension is not installed. This is required for database connection."
    exit 1
fi

echo "[INFO] Project ready for local development."
echo "[INFO] Ensure your MySQL service is running and you have imported 'database/schema.sql'."
echo "[INFO] Update credentials in 'api/includes/db.php' or set environment variables."
echo ""
echo "[INFO] Running PHP development server on http://localhost:8000 ..."

# Start the built-in PHP development server using the router
php -S localhost:8000 router.php
