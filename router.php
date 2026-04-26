<?php
/**
 * Local Router for PHP Development Server
 * Mimics Vercel's behavior by routing requests to the api/ directory
 * and serving static assets from the root.
 */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// 1. Serve static files (assets, etc.) if they exist in root
if (file_exists(__DIR__ . $path) && !is_dir(__DIR__ . $path)) {
    return false; // Built-in server handles this
}

// 2. Map root to api/index.php
if ($path === '/') {
    require __DIR__ . '/api/index.php';
    exit;
}

// 3. Map requests to the api/ folder
// Check if it's a direct .php file request
if (file_exists(__DIR__ . '/api' . $path) && !is_dir(__DIR__ . '/api' . $path)) {
    require __DIR__ . '/api' . $path;
    exit;
}

// Check if adding .php helps (e.g., /login -> /api/login.php)
if (file_exists(__DIR__ . '/api' . $path . '.php')) {
    require __DIR__ . '/api' . $path . '.php';
    exit;
}

// 4. Default to 404
http_response_code(404);
echo "404 - Not Found (Local Router)";
