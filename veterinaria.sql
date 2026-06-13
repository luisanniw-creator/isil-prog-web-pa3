create database veterinaria;
use veterinaria;
create table dueños(
  id int auto_increment primary key,
  nombre varchar(100),
  telefono varchar(20),
  direccion varchar(150));
create table mascotas(
  id int auto_increment primary key,
  nombre varchar(100),
  especie varchar(50),
  raza varchar(50),
  edad int,
  dueño_id int,
  foreign key (dueño_id) references dueños(id));
create table citas(
  id int auto_increment primary key,
  mascota_id int,
  fecha date,
  hora time,
  motivo text,
  estado varchar(30) default 'Pendiente',
  foreign key (mascota_id) references mascotas(id));


  
  