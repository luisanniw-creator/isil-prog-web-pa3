<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

$usuario = $_SESSION['usuario'];

include '../conexion.php';
$mensaje_alerta = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ruc = trim($_POST['ruc']);
    $nombre = trim($_POST['nombre_editorial']);
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['telefono']);

    $sql = "INSERT INTO editoriales (RUC, nombre_Editorial, direccion, telefono) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssss", $ruc, $nombre, $direccion, $telefono);

    try {
        if ($stmt->execute()) {
            $mensaje_alerta = '<div class="alert alert-success text-center mt-3 mb-0">¡Editorial Registrada!</div>';
        }
    } catch (mysqli_sql_exception $e) {
        $mensaje_alerta = '<div class="alert alert-danger text-center mt-3 mb-0">⚠️ El RUC ya existe o hubo un error.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registrar Editorial</title>
</head>

<body class="bg-light"><?php include("../navbar.php"); ?>
    <div class="container py-5 d-flex justify-content-center">
        <div class="card shadow-sm" style="width: 100%; max-width: 500px;">
            <div class="card-header bg-primary text-white text-center py-3">
                <h3 class="h5 mb-0">🏢 Registrar Editorial</h3>
            </div>
            <div class="card-body p-4">
                <form action="" method="POST">
                    <div class="mb-3"><label class="form-label">RUC</label><input class="form-control" type="text" name="ruc" maxlength="11" required></div>
                    <div class="mb-3"><label class="form-label">Nombre Editorial</label><input class="form-control" type="text" name="nombre_editorial" required></div>
                    <div class="mb-3"><label class="form-label">Dirección</label><input class="form-control" type="text" name="direccion" required></div>
                    <div class="mb-4"><label class="form-label">Teléfono</label><input class="form-control" type="text" name="telefono" required></div>
                    <button class="btn btn-primary w-100" type="submit">Guardar Editorial</button>
                </form><?php echo $mensaje_alerta; ?>
            </div>
        </div>
    </div>
</body>

</html>