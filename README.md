Create database 

CREATE DATABASE xss_lab;
USE xss_lab;

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    comment TEXT
);


