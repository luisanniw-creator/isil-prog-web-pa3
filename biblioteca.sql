create database biblioteca;
use biblioteca;

create table usuarios(
    ID int primary key auto_increment,
    usuario varchar(100),
    password varchar(255)
);

CREATE TABLE libros (
    codigo INT PRIMARY KEY,
    titulo VARCHAR(255),
    autor INT,
    editorial VARCHAR(11),
    año DATE,
    FOREIGN KEY (autor) REFERENCES autores(DNI),
    FOREIGN KEY (editorial) REFERENCES editoriales(RUC)
);

create table autores(
DNI int primary key ,
nombre varchar(255),
nacionalidad varchar(255));

CREATE TABLE editoriales(
    RUC VARCHAR(11) PRIMARY KEY,
    nombre_Editorial VARCHAR(255),
    direccion VARCHAR(150),
    telefono VARCHAR(20)
);

create table estudiantes(
  codigo int primary key,
  nombre varchar(255),
  apellido varchar(255),
  carrera varchar(255),
  telefono varchar(20)
  );

create table categoria(
  codigo int primary key,
  categoria varchar(255),
  descripcion text
  );

