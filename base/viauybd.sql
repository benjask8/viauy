CREATE DATABASE viauy;
USE viauy;

CREATE TABLE user (
    username VARCHAR(255) PRIMARY KEY,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    is_admin BOOLEAN DEFAULT 0
);

CREATE TABLE administrator (
    idAdministrator INT PRIMARY KEY,
    username VARCHAR(255),
    phone INT(9),
    email VARCHAR(255) UNIQUE,
    FOREIGN KEY (username) REFERENCES user(username)
);

CREATE TABLE passenger (
    idPassenger INT PRIMARY KEY,
    username VARCHAR(255),
    phone INT(9),
    email VARCHAR(255) UNIQUE,
    FOREIGN KEY (username) REFERENCES user(username)
);

CREATE TABLE company (
    companyName VARCHAR(255) PRIMARY KEY,
    companyEmail VARCHAR(255),
    password VARCHAR(255)
);

CREATE TABLE companyAdmin (
    idCompanyAdmin INT PRIMARY KEY,
    companyName VARCHAR(255),
    username VARCHAR(255),
    phone INT(9),
    email VARCHAR(255) UNIQUE,
    FOREIGN KEY (companyName) REFERENCES company(companyName),
    FOREIGN KEY (username) REFERENCES user(username)
);

CREATE TABLE route (
    idRoute INT PRIMARY KEY,
    origin VARCHAR(255),
    destination VARCHAR(255),
    departureTime TIME,
    arrivalTime TIME
);

CREATE TABLE routeStreets (
    idRoute INT PRIMARY KEY,
    street VARCHAR(255),
    FOREIGN KEY (idRoute) REFERENCES route(idRoute)
);

CREATE TABLE routeStops (
    idRoute INT PRIMARY KEY,
    stop VARCHAR(255),
    FOREIGN KEY (idRoute) REFERENCES route(idRoute)
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

CREATE TABLE busFeatures (
    idBus VARCHAR(255),
    feature VARCHAR(255),
    PRIMARY KEY (idBus, feature),
    FOREIGN KEY (idBus) REFERENCES bus(idBus)
);

CREATE TABLE travels (
    idRoute INT,
    idBus VARCHAR(255),
    PRIMARY KEY (idRoute, idBus),
    FOREIGN KEY (idRoute) REFERENCES route(idRoute),
    FOREIGN KEY (idBus) REFERENCES bus(idBus)
);

CREATE TABLE reservations (
    email VARCHAR(255),
    idPassenger INT,
    idRoute INT,
    idBus VARCHAR(255),
    idReservation INT PRIMARY KEY,
    seat VARCHAR(255),
    details VARCHAR(255),
    FOREIGN KEY (email) REFERENCES passenger(email),
    FOREIGN KEY (idPassenger) REFERENCES passenger(idPassenger),
    FOREIGN KEY (idRoute) REFERENCES route(idRoute),
    FOREIGN KEY (idBus) REFERENCES bus(idBus)
);

CREATE TABLE manages (
    idRoute INT,
    idBus VARCHAR(255),
    idCompanyAdmin INT,
    FOREIGN KEY (idCompanyAdmin) REFERENCES companyAdmin(idCompanyAdmin),
    FOREIGN KEY (idBus) REFERENCES bus(idBus),
    FOREIGN KEY (idRoute) REFERENCES route(idRoute)
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

