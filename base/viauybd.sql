CREATE DATABASE viauy;
USE viauy;

CREATE TABLE user (
    username VARCHAR(255) PRIMARY KEY,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    is_admin BOOLEAN DEFAULT 0
);

CREATE TABLE company (
    companyName VARCHAR(255) PRIMARY KEY,
    companyEmail VARCHAR(255),
    password VARCHAR(255)
);


CREATE TABLE busLine (
    idLine INT AUTO_INCREMENT PRIMARY KEY,
    origin VARCHAR(255),
    destination VARCHAR(255),
    departureTime TIME,
    arrivalTime TIME,
    idBus VARCHAR(255),
    ownerLine VARCHAR(255),
    name VARCHAR(255),
    departureDate DATE,
    price INT
);


CREATE TABLE bus (
    idBus VARCHAR(255) PRIMARY KEY,
    model VARCHAR(255),
    maximum_capacity INT,  -- Cambiado a INT para almacenar números enteros
    ownerBus VARCHAR(255),
    hasToilet TINYINT(1),  -- 1 si tiene baño, 0 si no
    hasWiFi TINYINT(1),    -- 1 si tiene WiFi, 0 si no
    hasAC TINYINT(1),       -- 1 si tiene aire acondicionado, 0 si no
    seatLayout VARCHAR(255)
);


CREATE TABLE reservation (
    idReservation INT AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(255),
    seat VARCHAR(255),
    idLine VARCHAR(255)
);


CREATE TABLE companyrequest (
    id INT AUTO_INCREMENT PRIMARY KEY,
    companyName VARCHAR(255),
    contactName VARCHAR(255),
    contactEmail VARCHAR(255),
    contactPhone VARCHAR(20),
    token VARCHAR(255),
    message TEXT,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    submissionDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

