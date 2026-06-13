create database biblioteca;
use biblioteca;

create table usuario(
ID int auto_increment primary key ,
usuario varchar(255),
contrasena varchar(255)
);

create table libros(
ID int auto_increment primary key ,
codigo int,
titulo varchar(255),
editorial varchar(255),
fecha date);

create table autores(
DNI int primary key ,
nombre varchar(255),
nacionalidad varchar(255));

create table editoriales(
RUC int primary key,
nombre_Editorial varchar(255),
direccion varchar(150),
telefono varchar(20));

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



  