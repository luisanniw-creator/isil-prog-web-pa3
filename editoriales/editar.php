<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}
$usuario = $_SESSION['usuario'];
include '../conexion.php';

if (!isset($_GET['ruc'])) {
    header("Location: listar.php");
    exit();
}

$ruc = $_GET['ruc'];
$stmt = $conexion->prepare("SELECT * FROM editoriales WHERE RUC = ?");
$stmt->bind_param("s", $ruc);
$stmt->execute();
$resultado = $stmt->get_result();
$editorial = $resultado->fetch_assoc();

if (!$editorial) {
    header("Location: listar.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Editorial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="bg-light">
    <?php include("../navbar.php"); ?>

    <div class="container py-5 d-flex justify-content-center">
        <div class="card shadow-sm" style="width: 100%; max-width: 600px;">
            <div class="card-header bg-warning text-dark text-center py-3">
                <h3 class="h5 mb-0">✏️ Editar Editorial</h3>
            </div>
            <div class="card-body p-4">
                <form action="actualizar.php" method="POST">

                    <input type="hidden" name="ruc" value="<?= htmlspecialchars($editorial['RUC']) ?>">

                    <div class="mb-3">
                        <label class="form-label">RUC</label>
                        <input class="form-control" type="text" value="<?= htmlspecialchars($editorial['RUC']) ?>" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre Editorial</label>
                        <input class="form-control" type="text" name="nombre_editorial" value="<?= htmlspecialchars($editorial['nombre_Editorial']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input class="form-control" type="text" name="direccion" value="<?= htmlspecialchars($editorial['direccion']) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Teléfono</label>
                        <input class="form-control" type="text" name="telefono" value="<?= htmlspecialchars($editorial['telefono']) ?>" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-success" type="submit">Actualizar Editorial</button>
                        <a href="listar.php" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>

</html>