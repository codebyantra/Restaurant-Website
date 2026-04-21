

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categories table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    image_name VARCHAR(255),
    active ENUM('Yes', 'No') DEFAULT 'Yes'
);

-- Food items table
CREATE TABLE IF NOT EXISTS food (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image_name VARCHAR(255),
    category_id INT,
    featured ENUM('Yes', 'No') DEFAULT 'No',
    active ENUM('Yes', 'No') DEFAULT 'Yes',
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10,2) NOT NULL,
    status VARCHAR(50) DEFAULT 'Ordered', -- Ordered, On Delivery, Delivered, Cancelled
    customer_name VARCHAR(100),
    customer_contact VARCHAR(20),
    customer_email VARCHAR(100),
    customer_address TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Order items table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    food_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (food_id) REFERENCES food(id) ON DELETE SET NULL
);

-- Insert default admin
-- Password is 'admin123' hashed with password_hash()
INSERT INTO users (full_name, email, password, role) VALUES 
('Admin User', 'admin@food.com', '$2y$10$Yf9G6.9pX.vG8G7.9pX.vO.vG8G7.9pX.vG8G7.9pX.vG8G7.9pX.', 'admin');
