create database ViaUY;
use ViaUY;

CREATE TABLE User (
    id INT PRIMARY KEY AUTO_INCREMENT,
    userName VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255)
);


create table Administrador(
ciA int,
idAdmin int auto_increment,
nombre char,
apellido char,
teléfono int(9),
correo char,
primary key(idAdmin,correo),
foreign key (correo) references Usuarios(correo)
);

create table Usuario(
ciU int,
idUsuario int auto_increment,
nombre char,
apellido char,
teléfono int(9),
correo char,
primary key(idUsuario,correo),
foreign key (correo) references Usuarios(correo)
);

create table Empresa(
nombreEmpresa char primary key,
teléfono int(9)
);

create table AdminEmpresa(
ciE int,
idAdminE int auto_increment,
nombreEmpresa char,
nombre char,
apellido char,
teléfono int(9),
correo char,
primary key(idAdminE,correo,nombreEmpresa),
foreign key (correo) references Usuarios(correo),
foreign key (nombreEmpresa) references Empresa(nombreEmpresa)
);

create table Línea(
idLinea int auto_increment primary key,
origen char,
destino char,
horaLlegada char,
horaPartida char
);

create table CallesL(
idLinea int auto_increment primary key,
calles char,
foreign key (idLinea) references Línea(idLinea)
);

create table ParadasL(
idLinea int auto_increment primary key,
paradas char,
foreign key (idLinea) references Línea(idLinea)
);

create table Omnibus(
idOmnibus  int auto_increment primary key
);

create table CaracteristicasO(
idOmnibus  int auto_increment,
caracteristicas char,
primary key(idOmnibus,caracteristicas),
foreign key (idOmnibus) references Omnibus(idOmnibus)
);

create table Recorre(
idLinea int,
idOmnibus int,
foreign key (idOmnibus) references Omnibus(idOmnibus),
foreign key (idLinea) references Línea(idLinea),
primary key (idLinea,idOmnibus)
);

create table HaceReserva(
correo char,
idUsuario int,
idLinea int,
idOmnibus int,
idReserva int auto_increment unique,
asiento char,
detalles char,
primary key(idReserva,correo,idUsuario,idLinea,idOmnibus),
foreign key(correo) references Usuario(correo),
foreign key(idUsuario) references Usuario(idUsuario),
foreign key(idLinea) references Línea(idLinea),
foreign key (idOmnibus) references Omnibus(idOmnibus)
);

create table Gestiona(
idLinea int,
idOmnibus int,
idAdminE int,
foreign key(idAdminE) references AdminEmpresa(idAdminE),
foreign key (idOmnibus) references Omnibus(idOmnibus),
foreign key(idLinea) references Línea(idLinea)
);