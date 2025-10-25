-- CREATE DATABASE `DB_NAME_PLACEHOLDER` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE `DB_NAME_PLACEHOLDER`;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(190) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('user','admin') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- INSERT INTO users (name, email, password_hash, role) VALUES
-- ('Admin', 'admin@example.com', '$2y$10$REPLACE_WITH_password_hash', 'admin');
