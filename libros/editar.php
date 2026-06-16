<?php
// 1. INICIAR SESIÓN Y CONTROL DE ACCESO
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}
$usuario = $_SESSION['usuario'];

// 2. CONEXIÓN A LA BASE DE DATOS
include("../conexion.php");

// 3. CAPTURAR EL CÓDIGO DEL LIBRO DESDE LA URL
if (isset($_GET['codigo'])) {
    $id = $_GET['codigo'];

    $stmt = $conexion->prepare("SELECT * FROM libros WHERE codigo = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $libro = $resultado->fetch_assoc();

    if (!$libro) {
        header("Location: listar.php");
        exit();
    }
} else {
    header("Location: listar.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">

    <?php include("../navbar.php"); ?>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-5">

                <div class="card shadow">
                    <div class="card-header bg-warning text-dark text-center py-3">
                        <h3 class="h5 mb-0 fw-bold">✏️ Editar Libro</h3>
                    </div>

                    <div class="card-body p-4">
                        <form action="actualizar.php" method="POST">

                            <input type="hidden" name="codigo" value="<?= $libro['codigo'] ?>">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Título</label>
                                <input type="text" name="titulo" value="<?= htmlspecialchars($libro['titulo']) ?>" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Autor</label>
                                <input type="text" name="autor" value="<?= htmlspecialchars($libro['autor']) ?>" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Editorial</label>
                                <input type="text" name="editorial" value="<?= htmlspecialchars($libro['editorial']) ?>" class="form-control" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Fecha de Publicación (Año)</label>
                                <input type="date" name="anio" value="<?= $libro['año'] ?>" class="form-control" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-success" type="submit">Actualizar Datos</button>
                                <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>