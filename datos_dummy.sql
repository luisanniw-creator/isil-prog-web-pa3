-- Datos de prueba para la base de datos "biblioteca"
-- Ejecutar despues de haber creado las tablas con biblioteca.sql
USE biblioteca_test;

-- USUARIOS (para el login)
INSERT INTO usuario (usuario, contrasena) VALUES
('admin', 'admin'),
('bibliotecario', '123456'),
('maria', 'maria123');

-- AUTORES
INSERT INTO autores (DNI, nombre, nacionalidad) VALUES
(10111213, 'Gabriel Garcia Marquez', 'Colombiana'),
(20222324, 'Mario Vargas Llosa', 'Peruana'),
(30333435, 'Julio Cortazar', 'Argentina'),
(40444546, 'Isabel Allende', 'Chilena'),
(50555657, 'Jorge Luis Borges', 'Argentina');

-- EDITORIALES
INSERT INTO editoriales (RUC, nombre_Editorial, direccion, telefono) VALUES
(20100100100, 'Editorial Planeta', 'Av. Larco 123, Lima', '014561234'),
(20200200200, 'Penguin Random House', 'Calle Las Begonias 456, Lima', '015678901'),
(20300300300, 'Editorial Santillana', 'Jr. Union 789, Lima', '013344556'),
(20400400400, 'Fondo de Cultura Economica', 'Av. Arequipa 1010, Lima', '017788990');

-- LIBROS
INSERT INTO libros (codigo, titulo, autor, editorial, anio) VALUES
(1001, 'Cien anios de soledad', 'Gabriel Garcia Marquez', 'Editorial Planeta', 1967),
(1002, 'La ciudad y los perros', 'Mario Vargas Llosa', 'Penguin Random House', 1963),
(1003, 'Rayuela', 'Julio Cortazar', 'Editorial Santillana', 1963),
(1004, 'La casa de los espiritus', 'Isabel Allende', 'Editorial Planeta', 1982),
(1005, 'Ficciones', 'Jorge Luis Borges', 'Fondo de Cultura Economica', 1944),
(1006, 'El amor en los tiempos del colera', 'Gabriel Garcia Marquez', 'Editorial Planeta', 1985);

-- ESTUDIANTES
INSERT INTO estudiantes (codigo, nombre, apellido, carrera, telefono) VALUES
(2001, 'Lucia', 'Ramirez Soto', 'Administracion', '987654321'),
(2002, 'Carlos', 'Torres Diaz', 'Ingenieria de Sistemas', '912345678'),
(2003, 'Andrea', 'Flores Quispe', 'Contabilidad', '998877665'),
(2004, 'Diego', 'Mendoza Rojas', 'Diseno Grafico', '955443322'),
(2005, 'Valeria', 'Castro Leon', 'Marketing', '966112233');

-- CATEGORIAS
INSERT INTO categoria (codigo, categoria, descripcion) VALUES
(3001, 'Novela', 'Obras narrativas de ficcion extensas'),
(3002, 'Cuento', 'Narraciones breves de ficcion'),
(3003, 'Poesia', 'Obras escritas en verso'),
(3004, 'Ensayo', 'Textos reflexivos sobre un tema'),
(3005, 'Historia', 'Libros sobre acontecimientos historicos');
