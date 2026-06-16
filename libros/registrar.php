<?php
// 1. INICIAR SESIÓN Y VALIDAR ACCESO (¡Siempre al principio de todo!)
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}
$usuario = $_SESSION['usuario'];

// 2. CONEXIÓN A LA BASE DE DATOS
include '../conexion.php';

$mensaje_alerta = "";

// Aseguramos que la petición venga por POST antes de intentar registrar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Capturamos los datos del formulario
    $codigo = trim($_POST['codigo']);
    $titulo = trim($_POST['titulo']);
    $autor = trim($_POST['autor']);
    $editorial = trim($_POST['editorial']);
    $anio = trim($_POST['anio']);

    // Usamos exactamente el nombre 'año' de tu BD
    $sql = "INSERT INTO libros (codigo, titulo, autor, editorial, año) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    // "issss" -> 'i' (int), 'ssss' (strings)
    $stmt->bind_param("issss", $codigo, $titulo, $autor, $editorial, $anio);

    if ($stmt->execute()) {
        $mensaje_alerta = '<div class="alert alert-success text-center mt-3 mb-0" role="alert">
                             ¡Libro Registrado con Éxito!
                           </div>';
    } else {
        $mensaje_alerta = '<div class="alert alert-danger text-center mt-3 mb-0" role="alert">
                             Error al registrar el libro: ' . $conexion->error . '
                           </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registrar Libro</title>
</head>

<body class="bg-light">

    <?php include("../navbar.php"); ?>

    <div class="container py-5 d-flex justify-content-center">
        <div class="card shadow-sm" style="width: 100%; max-width: 500px;">
            <div class="card-header bg-primary text-white text-center py-3">
                <h3 class="h5 mb-0">📚 Registrar Nuevo Libro</h3>
            </div>

            <div class="card-body p-4">
                <form action="" method="POST">

                    <div class="mb-3">
                        <label class="form-label">Código del Libro</label>
                        <input class="form-control" type="number" name="codigo" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Título</label>
                        <input class="form-control" type="text" name="titulo" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Autor</label>
                        <input class="form-control" type="text" name="autor" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Editorial</label>
                        <input class="form-control" type="text" name="editorial" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Fecha de Publicación (Año)</label>
                        <input class="form-control" type="date" name="anio" required>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">
                        Guardar Libro
                    </button>
                </form>

                <?php echo $mensaje_alerta; ?>
            </div>
        </div>
    </div>

</body>

</html>