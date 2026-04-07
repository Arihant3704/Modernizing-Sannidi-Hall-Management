# Vercel Deployment Guide for Sannidi Hall Management

This project is now configured to work with Vercel using the community PHP runtime.

## Prerequisites
1.  **MySQL Database**: Vercel does not host MySQL. You must host your database externally.
    *   **Recommended**: [Aiven](https://aiven.io/mysql), [PlanetScale](https://planetscale.com/), or any managed MySQL provider.
2.  **Environment Variables**: You'll need to set the database credentials in the Vercel Dashboard.

## Deployment Steps
1.  **Connect to Vercel**: Connect this repository to your Vercel account.
2.  **Set Environment Variables**: In the Vercel Dashboard (**Settings > Environment Variables**), add the following:
    *   `DB_HOST`: Your database host (e.g., `mysql-123.aivencloud.com`)
    *   `DB_USER`: Your database username
    *   `DB_PASSWORD`: Your database password
    *   `DB_NAME`: Your database name (`sannidi_hall`)
    *   `DB_PORT`: `3306` (or as provided by your host)
3.  **Deploy**: Push your changes to the main branch or run `vercel deploy` locally.

## Features Added
-   **`vercel.json`**: Configures the PHP runtime and sets up basic security rules:
    -   Blocks direct access to `includes/db.php` (contains sensitive connection code).
    -   Blocks access to the `database/` folder and other metadata files (`Dockerfile`, `render.yaml`).
    -   Handles all other `.php` files as serverless functions.
-   **Assets Handling**: Static assets (CSS, images) in the `assets/` directory are automatically served correctly.

## Note on Sessions
PHP sessions in serverless environments like Vercel can be ephemeral. If you experience unexpected logouts, consider implementing a session handler that stores session data in your MySQL database.
