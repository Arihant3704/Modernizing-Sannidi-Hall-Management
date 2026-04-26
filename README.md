# Sannidi Hall Management System

A premium, modern web application for managing event hall bookings, built with PHP and MySQL. It features a stunning "glassmorphism" UI with deep charcoal and royal gold accents, delivering a high-end experience for both administrators and customers.

## Features
- **Unified Authentication:** Secure login for both `admin` and `user` roles using `password_hash` validation.
- **Vercel Ready:** Fully configured for deployment on Vercel using Serverless Functions.
- **Premium Dashboards:** Intuitive portals for users to book halls and for admins to manage reservations.
- **Responsive Design:** Custom-built "glassmorphism" UI that works beautifully across all devices.

## Project Structure
The codebase is optimized for serverless deployment:
- `api/` - **New!** Contains all core PHP logic and pages (`index.php`, `admin/`, `user/`, `includes/`). Moved here to work as Vercel functions.
- `assets/` - Contains static styling (`css/index.css`) and high-quality premium event `images/`.
- `database/` - Stores the initial `schema.sql` for your MySQL setup.
- `vercel.json` - Configuration for Vercel deployment and routing.
- `router.php` - Local router to mimic Vercel's behavior during development.

## Installation & Setup (Local)

1. **Database Configuration**
   - Ensure your MySQL server is active.
   - Create a database named `sannidi_hall`.
   - Import the schema:
     ```bash
     mysql -u [your_user] -p sannidi_hall < database/schema.sql
     ```
   - Update your credentials in `api/includes/db.php` or set environment variables (recommended).

2. **Run the Application**
   - Use the provided start script to launch the local server with the custom router:
     ```bash
     chmod +x start.sh
     ./start.sh
     ```
   - Open your browser at [http://localhost:8000](http://localhost:8000).

## Deployment (Vercel)
This project is pre-configured for Vercel:
1. Push this code to GitHub.
2. Link the repository to Vercel.
3. Add your MySQL credentials in Vercel's **Environment Variables**:
   - `DB_HOST`, `DB_USER`, `DB_PASSWORD`, `DB_NAME`, `DB_PORT`
4. Deploy!

For more deployment details, see `VERCEL_DEPLOYMENT.md`.
