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

echo "[INFO] Ensure your MySQL service is running and you have imported 'schema.sql'."
echo "[INFO] Running PHP development server on http://localhost:8000 ..."
echo ""

# Start the built in PHP development server
php -S localhost:8000
