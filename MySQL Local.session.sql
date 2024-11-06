CREATE TABLE IF NOT EXISTS Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO Users (username, email, password)
VALUES ('new_username', 'user@example.com', 'hashed_password');
SELECT * FROM  USERS;
CREATE TABLE hospitals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    established_year INT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    speciality VARCHAR(100),
    experience_years INT,
    gender ENUM('Male', 'Female', 'Other'),
    hospital_id INT,
    FOREIGN KEY (hospital_id) REFERENCES hospitals(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO hospitals (name, address, city, state, country, phone, email, established_year)
VALUES 
    ('Apollo', 'Jubilee Hills', 'Hyderabad', 'Telangana', 'India', '+1234567890', 'apollo@cityhospital.com', '1990'),
    ('Kims', 'Secunderabad', 'Hyderabad', 'Telangana', 'India', '+9234567890', 'kims@cityhospital.com', '1970');
select *from hospitals;
INSERT INTO doctors (first_name, last_name, email, phone, speciality, experience_years, gender, hospital_id)
VALUES 
    ('Ravikanth', 'Gupta', 'john.doe@example.com', '+1234567890', 'General Physician', 10, 'Male', 1),
    ('Shreya', 'Sharma', 'jane.smith@example.com', '+1987654321', 'Orthopaedist', 8, 'Female', 2),
    ('Srikanth', 'Varma', 'michael.brown@example.com', '+1654321897', 'Orthopaedist', 12, 'Male', 1),
    ('Lily', 'Johnson', 'emily.johnson@example.com', '+1765432987', 'General Physician', 15, 'Female', 2);
INSERT INTO doctors (first_name, last_name, email, phone, speciality, experience_years, gender, hospital_id)
VALUES 
    ('Prerna', 'Reddy', 'prerna.reddy@example.com', '+1535467890', 'Dentist', 10, 'Female', 1),
    ('Gopal', 'Chowdhary', 'gopal.chowdhary@example.com', '+1987654321', 'Dentist', 8, 'Male', 2);
SELECT * from doctors;
