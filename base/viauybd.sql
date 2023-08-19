CREATE DATABASE ViaUY;
USE ViaUY;

CREATE TABLE User (
    username VARCHAR(255) PRIMARY KEY ,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255)
);

CREATE TABLE Administrator (
    idAdministrator INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    phone INT(9),
    email VARCHAR(255) UNIQUE,
    FOREIGN KEY (username) REFERENCES User(username)
);

CREATE TABLE Passenger (
    idPassenger INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    phone INT(9),
    email VARCHAR(255) UNIQUE,
    FOREIGN KEY (username) REFERENCES User(username)
);

CREATE TABLE Company (
    companyName VARCHAR(255) PRIMARY KEY,
    phone INT(9)
);

CREATE TABLE CompanyAdmin (
    idCompanyAdmin INT AUTO_INCREMENT PRIMARY KEY,
    companyName VARCHAR(255),
    username VARCHAR(255),
    phone INT(9),
    email VARCHAR(255) UNIQUE,
    FOREIGN KEY (companyName) REFERENCES Company(companyName),
    FOREIGN KEY (username) REFERENCES User(username)
);

CREATE TABLE Route (
    idRoute INT AUTO_INCREMENT PRIMARY KEY,
    origin VARCHAR(255),
    destination VARCHAR(255),
    departureTime TIME,
    arrivalTime TIME
);

CREATE TABLE RouteStreets (
    idRoute INT AUTO_INCREMENT PRIMARY KEY,
    street VARCHAR(255),
    FOREIGN KEY (idRoute) REFERENCES Route(idRoute)
);

CREATE TABLE RouteStops (
    idRoute INT AUTO_INCREMENT PRIMARY KEY,
    stop VARCHAR(255),
    FOREIGN KEY (idRoute) REFERENCES Route(idRoute)
);

CREATE TABLE Bus (
    idBus INT AUTO_INCREMENT PRIMARY KEY
);

CREATE TABLE BusFeatures (
    idBus INT AUTO_INCREMENT,
    feature VARCHAR(255),
    PRIMARY KEY (idBus, feature),
    FOREIGN KEY (idBus) REFERENCES Bus(idBus)
);

CREATE TABLE Travels (
    idRoute INT,
    idBus INT,
    PRIMARY KEY (idRoute, idBus),
    FOREIGN KEY (idRoute) REFERENCES Route(idRoute),
    FOREIGN KEY (idBus) REFERENCES Bus(idBus)
);

CREATE TABLE Reservations (
    email VARCHAR(255),
    idPassenger INT,
    idRoute INT,
    idBus INT,
    idReservation INT AUTO_INCREMENT PRIMARY KEY,
    seat VARCHAR(255),
    details VARCHAR(255),
    FOREIGN KEY (email) REFERENCES Passenger(email),
    FOREIGN KEY (idPassenger) REFERENCES Passenger(idPassenger),
    FOREIGN KEY (idRoute) REFERENCES Route(idRoute),
    FOREIGN KEY (idBus) REFERENCES Bus(idBus)
);

CREATE TABLE Manages (
    idRoute INT,
    idBus INT,
    idCompanyAdmin INT,
    FOREIGN KEY (idCompanyAdmin) REFERENCES CompanyAdmin(idCompanyAdmin),
    FOREIGN KEY (idBus) REFERENCES Bus(idBus),
    FOREIGN KEY (idRoute) REFERENCES Route(idRoute)
);
