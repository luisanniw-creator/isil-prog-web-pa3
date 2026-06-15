<?php
session_start();

// CONTROL DE ACCESO: Si no existe la sesión, mandarlo al login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// RECUPERAR EL NOMBRE: Guardamos el valor en la variable que ya usas abajo
$usuario = $_SESSION['usuario'];

include("navbar.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/estilos.css">

    <style>
        body {
            background: #879fc4;
        }

        .hero {
            height: 85vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .card-opcion {
            transition: 0.3s;
            border: none;
            border-radius: 20px;
            overflow: hidden;
        }

        .card-opcion:hover {
            transform: translateY(-10px);
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
        }

        .icono {
            font-size: 60px;
        }
    </style>
</head>

<body>

    <div class="container hero">
        <div class="row g-4">

            <h2 class="bs-info">Bienvenido <?= $usuario ?></h2>

            <div class="col-md-4">
                <div class="card card-opcion shadow-lg">
                    <div class="card-body p-2">
                        <div class="icono"></div>
                        <h2 class="mt-3">Módulo Libros</h2>
                        <div class="icono">📚</div>
                        <p>Registro y listado de autores.</p>

                        <a href="libros/registrar.php" class="btn btn-primary">
                            Registrar Libro
                        </a>

                        <a href="libros/listar.php" class="btn btn-success">
                            Listar Libro
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-opcion shadow-lg">
                    <div class="card-body p-2">
                        <div class="icono"></div>
                        <h2 class="mt-3">Módulo Autores</h2>
                        <div class="icono">👤</div>
                        <p>Registro y listado de Autores</p>

                        <a href="autores/registrar.php" class="btn btn-primary">
                            Registrar Autor
                        </a>

                        <a href="autores/listar.php" class="btn btn-success">
                            Listar Autores
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-opcion shadow-lg">
                    <div class="card-body p-2">
                        <div class="icono"></div>
                        <h2 class="mt-3">Módulo Editoriales</h2>
                        <div class="icono">🏢</div>
                        <p>Registro y listado de Editoriales.</p>

                        <a href="editoriales/registrar.php" class="btn btn-primary">
                            Registrar Editorial
                        </a>

                        <a href="editoriales/listar.php" class="btn btn-success">
                            Listar Editoriales
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-opcion shadow-lg">
                    <div class="card-body p-2">
                        <div class="icono"></div>
                        <h2 class="mt-3">Módulo Estudiantes</h2>
                        <div class="icono">🎓</div>
                        <p>Registro y listado de Estudiantes.</p>

                        <a href="estudiantes/registrar.php" class="btn btn-primary">
                            Registrar Estudiante
                        </a>

                        <a href="estudiantes/listar.php" class="btn btn-success">
                            Listar Estudiantes
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-opcion shadow-lg">
                    <div class="card-body p-2">
                        <div class="icono"></div>
                        <h2 class="mt-3">Módulo Categorias</h2>
                        <div class="icono">📅</div>
                        <p>Registro y listado de Categorías.</p>

                        <a href="categorias/registrar.php" class="btn btn-primary">
                            Registrar Categoria
                        </a>

                        <a href="categorias/listar.php" class="btn btn-success">
                            Listar Categorias
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>