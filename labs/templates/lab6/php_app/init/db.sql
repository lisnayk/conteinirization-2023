-- Create the database
CREATE DATABASE IF NOT EXISTS mydb;
USE mydb;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  image VARCHAR(255) DEFAULT NULL
);

-- Seed the users table with sample data
INSERT INTO users (username, email, image) VALUES
  ('johndoe', 'johndoe@example.com', 'https://picsum.photos/id/64/300/300'),
  ('janedoe', 'janedoe@example.com', 'https://picsum.photos/id/65/300/300'),
  ('bobsmith', 'bobsmith@example.com', 'https://picsum.photos/id/342/300/300'),
  ('alicesmith', 'alicesmith@example.com', 'https://picsum.photos/id/375/300/300');
