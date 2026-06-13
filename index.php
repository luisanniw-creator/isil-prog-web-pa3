<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
$ruta = "";
include("navbar.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal - Biblioteca El Saber</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{ background:#f4f6f9; }
        .card-opcion{
            transition:0.3s;
            border:none;
            border-radius:20px;
            text-decoration:none;
            color:inherit;
        }
        .card-opcion:hover{
            transform:translateY(-10px);
            box-shadow:0px 10px 25px rgba(0,0,0,0.2);
        }
        .icono{ font-size:55px; }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="text-center mb-5">
        <h1>Dashboard</h1>
        <p class="text-muted">Bienvenido(a), <strong><?= $_SESSION['usuario'] ?></strong></p>
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <a href="libros/libros.php" class="card card-opcion shadow-lg h-100">
                <div class="card-body p-5 text-center">
                    <div class="icono">📚</div>
                    <h4 class="mt-3">Libros</h4>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="autores/autores.php" class="card card-opcion shadow-lg h-100">
                <div class="card-body p-5 text-center">
                    <div class="icono">👤</div>
                    <h4 class="mt-3">Autores</h4>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="editoriales/editoriales.php" class="card card-opcion shadow-lg h-100">
                <div class="card-body p-5 text-center">
                    <div class="icono">🏢</div>
                    <h4 class="mt-3">Editoriales</h4>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="estudiantes/estudiantes.php" class="card card-opcion shadow-lg h-100">
                <div class="card-body p-5 text-center">
                    <div class="icono">🎓</div>
                    <h4 class="mt-3">Estudiantes</h4>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="categorias/categorias.php" class="card card-opcion shadow-lg h-100">
                <div class="card-body p-5 text-center">
                    <div class="icono">📖</div>
                    <h4 class="mt-3">Categorías</h4>
                </div>
            </a>
        </div>

    </div>
</div>

</body>
</html>
