CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY,
    email TEXT NOT NULL UNIQUE,
    name TEXT NOT NULL,
    password TEXT NOT NULL
);


INSERT INTO users (email, name, password) VALUES ('example@example.com', 'John Doe', 'password123');
SELECT * from users;
