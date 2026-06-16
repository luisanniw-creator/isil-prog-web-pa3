<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

include '../conexion.php';

if (!isset($_GET['codigo'])) {
    header("Location: listar.php");
    exit();
}

$codigo = intval($_GET['codigo']);
$stmt = $conexion->prepare("SELECT * FROM categoria WHERE codigo = ?");
$stmt->bind_param("i", $codigo);
$stmt->execute();
$resultado = $stmt->get_result();
$categoria = $resultado->fetch_assoc();

if (!$categoria) {
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
    <title>Editar Categoría</title>
</head>
<body class="bg-light">
    <?php include("../navbar.php"); ?>
    <div class="container py-5 d-flex justify-content-center">
        <div class="card shadow-sm" style="width:100%; max-width:600px;">
            <div class="card-header bg-warning text-dark text-center py-3">
                <h3 class="h5 mb-0">✏️ Editar Categoría</h3>
            </div>
            <div class="card-body p-4">
                <form action="actualizar.php" method="POST">
                    <input type="hidden" name="codigo" value="<?= $categoria['codigo'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Código</label>
                        <input class="form-control" type="number" value="<?= $categoria['codigo'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Categoría</label>
                        <input class="form-control" type="text" name="categoria" value="<?= htmlspecialchars($categoria['categoria']) ?>" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Descripción</label>
                        <input class="form-control" type="text" name="descripcion" value="<?= htmlspecialchars($categoria['descripcion']) ?>" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-success" type="submit">Actualizar Categoría</button>
                        <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
