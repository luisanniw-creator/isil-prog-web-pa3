<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

if (!isset($_GET['dni'])) {
    header("Location: listar.php");
    exit();
}

$dni = intval($_GET['dni']);
$stmt = $conexion->prepare("SELECT * FROM autores WHERE DNI = ?");
$stmt->bind_param("i", $dni);
$stmt->execute();
$resultado = $stmt->get_result();
$autor = $resultado->fetch_assoc();

if (!$autor) {
    header("Location: listar.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Autor</title>
</head>
<body class="bg-light">
    <?php include("../navbar.php"); ?>
    <div class="container py-5 d-flex justify-content-center">
        <div class="card shadow-sm" style="width:100%; max-width:500px;">
            <div class="card-header bg-warning text-dark text-center py-3">
                <h3 class="h5 mb-0">✏️ Editar Autor</h3>
            </div>
            <div class="card-body p-4">
                <form action="actualizar.php" method="POST">
                    <input type="hidden" name="DNI" value="<?= $autor['DNI'] ?>">
                    <div class="mb-3">
                        <label class="form-label">DNI</label>
                        <input class="form-control" type="text" value="<?= $autor['DNI'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" type="text" name="nombre" value="<?= htmlspecialchars($autor['nombre']) ?>" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Nacionalidad</label>
                        <input class="form-control" type="text" name="nacionalidad" value="<?= htmlspecialchars($autor['nacionalidad']) ?>" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" type="submit">Actualizar Autor</button>
                        <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
