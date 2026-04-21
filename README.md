# Online Food Ordering System

A professional, full-stack Online Food Ordering Website built with HTML, CSS, JavaScript, PHP, and MySQL.

## Features
- **User Side:**
  - User Registration and Login (Password Hashing)
  - Browse Food Categories and Items
  - Search Functionality
  - Add to Cart (JavaScript & LocalStorage)
  - Checkout Process
  - Order History
- **Admin Side:**
  - Admin Dashboard with Statistics
  - Category Management (CRUD)
  - Food Item Management (CRUD)
  - Order Management (Update Status)
  - Secure Session-based Authentication

## Project Structure
- `/admin`: Admin panel pages
- `/assets`: CSS, JS, and Images
- `/includes`: PHP configuration, authentication, and reusable partials
- `/user`: User-specific logic (optional expansion)
- `database.sql`: Database schema and initial data

## Setup Instructions
1. **Database Setup:**
   - Open PHPMyAdmin or your MySQL client.
   - Create a database named `food_order_db`.
   - Import the `database.sql` file.
2. **Configuration:**
   - Open `includes/config.php`.
   - Update `DB_HOST`, `DB_USER`, `DB_PASS`, and `SITEURL` to match your local environment.
3. **Admin Access:**
   - **Email:** `admin@food.com`
   - **Password:** `admin123`
4. **Running the Project:**
   - Place the `food_order_system` folder in your web server's root directory (e.g., `htdocs` for XAMPP).
   - Access the site via `http://localhost/food_order_system/`.

## Security Features
- Prepared SQL statements to prevent SQL Injection.
- Password hashing using `password_hash()`.
- Session-based authentication for both users and admins.
- Input sanitization.
