create database biblioteca_test;
use biblioteca_test;

create table usuario(
ID int auto_increment primary key ,
usuario varchar(255),
contrasena varchar(255)
);

-- Usuario de prueba para el login (usuario: admin / contrasena: admin)
insert into usuario (usuario, contrasena) values ('admin', 'admin');

-- autores y editoriales se crean ANTES que libros porque libros las referencia.
-- nombre y nombre_Editorial llevan UNIQUE para poder ser usados como foreign key.
create table autores(
DNI int primary key ,
nombre varchar(255) unique,
nacionalidad varchar(255));

create table editoriales(
RUC int primary key,
nombre_Editorial varchar(255) unique,
direccion varchar(150),
telefono varchar(20));

create table libros(
ID int auto_increment primary key ,
codigo int,
titulo varchar(255),
autor varchar(255), foreign key (autor) references autores(nombre),
editorial varchar(255), foreign key (editorial) references editoriales(nombre_Editorial),
anio int);

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
