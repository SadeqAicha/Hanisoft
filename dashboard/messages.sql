CREATE TABLE IF NOT EXISTS messages (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    message TEXT,
    `read` BOOLEAN
);