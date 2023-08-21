CREATE DATABASE viauy;
USE viauy;

CREATE TABLE user (
    username VARCHAR(255) PRIMARY KEY ,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    is_admin BOOLEAN DEFAULT 0
);

CREATE TABLE administrator (
    idAdministrator INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    phone INT(9),
    email VARCHAR(255) UNIQUE,
    FOREIGN KEY (username) REFERENCES user(username)
);

CREATE TABLE passenger (
    idPassenger INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    phone INT(9),
    email VARCHAR(255) UNIQUE,
    FOREIGN KEY (username) REFERENCES user(username)
);

CREATE TABLE company (
    companyName VARCHAR(255) PRIMARY KEY,
    phone INT(9)
);

CREATE TABLE companyAdmin (
    idCompanyAdmin INT AUTO_INCREMENT PRIMARY KEY,
    companyName VARCHAR(255),
    username VARCHAR(255),
    phone INT(9),
    email VARCHAR(255) UNIQUE,
    FOREIGN KEY (companyName) REFERENCES company(companyName),
    FOREIGN KEY (username) REFERENCES user(username)
);

CREATE TABLE route (
    idRoute INT AUTO_INCREMENT PRIMARY KEY,
    origin VARCHAR(255),
    destination VARCHAR(255),
    departureTime TIME,
    arrivalTime TIME
);

CREATE TABLE routeStreets (
    idRoute INT AUTO_INCREMENT PRIMARY KEY,
    street VARCHAR(255),
    FOREIGN KEY (idRoute) REFERENCES route(idRoute)
);

CREATE TABLE routeStops (
    idRoute INT AUTO_INCREMENT PRIMARY KEY,
    stop VARCHAR(255),
    FOREIGN KEY (idRoute) REFERENCES route(idRoute)
);

CREATE TABLE bus (
    idBus INT AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE busFeatures (
    idBus INT AUTO_INCREMENT,
    feature VARCHAR(255),
    PRIMARY KEY (idBus, feature),
    FOREIGN KEY (idBus) REFERENCES bus(idBus)
);

CREATE TABLE travels (
    idRoute INT,
    idBus INT,
    PRIMARY KEY (idRoute, idBus),
    FOREIGN KEY (idRoute) REFERENCES route(idRoute),
    FOREIGN KEY (idBus) REFERENCES bus(idBus)
);

CREATE TABLE reservations (
    email VARCHAR(255),
    idPassenger INT,
    idRoute INT,
    idBus INT,
    idReservation INT AUTO_INCREMENT PRIMARY KEY,
    seat VARCHAR(255),
    details VARCHAR(255),
    FOREIGN KEY (email) REFERENCES passenger(email),
    FOREIGN KEY (idPassenger) REFERENCES passenger(idPassenger),
    FOREIGN KEY (idRoute) REFERENCES route(idRoute),
    FOREIGN KEY (idBus) REFERENCES bus(idBus)
);

CREATE TABLE manages (
    idRoute INT,
    idBus INT,
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
    message TEXT,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    submissionDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
