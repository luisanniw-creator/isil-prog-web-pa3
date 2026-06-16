<?php
// 1. INICIAR SESIÓN
session_start();

// 2. CONTROL DE ACCESO: Si no está logueado, mandarlo al login de la raíz
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

// 3. RECUPERAR EL NOMBRE: Así el navbar lo puede pintar correctamente
$usuario = $_SESSION['usuario'];

// 4. NAVBAR
include("../navbar.php");

// 5. PROCESAR EL GUARDADO DE ESTUDIANTES (Se ejecuta en este mismo archivo)
include("../conexion.php");
$mensaje_alerta = ""; // Variable para guardar el mensaje de éxito o error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturamos los 5 campos del formulario de estudiantes
    $codigo = trim($_POST['codigo']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $carrera = trim($_POST['carrera']);
    $telefono = trim($_POST['telefono']);

    // Consulta SQL dirigida a la tabla 'estudiantes' con sus 5 columnas
    $sql = "INSERT INTO estudiantes (codigo, nombre, apellido, carrera, telefono) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    // CORRECCIÓN: "issss" -> 'i' porque el código es INT (entero), y 4 's' para los demás textos
    $stmt->bind_param("issss", $codigo, $nombre, $apellido, $carrera, $telefono);

    if ($stmt->execute()) {
        // Alerta estética de Bootstrap para éxito
        $mensaje_alerta = '<div class="alert alert-success text-center mt-3 mb-0" role="alert">
                             ¡Estudiante Registrado con Éxito!
                           </div>';
    } else {
        // Alerta estética de Bootstrap para error (por si el código se duplica, por ejemplo)
        $mensaje_alerta = '<div class="alert alert-danger text-center mt-3 mb-0" role="alert">
                             Error al registrar el estudiante: ' . $conexion->error . '
                           </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Registrar Estudiante</title>
</head>

<body class="bg-light">

    <div class="container py-5 d-flex justify-content-center">

        <div class="card shadow-sm" style="width: 100%; max-width: 500px;">
            <div class="card-header bg-primary text-white text-center py-3">
                <h3 class="h5 mb-0">🎓 Registrar Nuevo Estudiante</h3>
            </div>

            <div class="card-body p-4">
                <form action="" method="POST">

                    <div class="mb-3">
                        <label class="form-label">Código del Estudiante</label>
                        <input class="form-control" type="number" name="codigo" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" type="text" name="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Apellido</label>
                        <input class="form-control" type="text" name="apellido" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Carrera</label>
                        <input class="form-control" type="text" name="carrera" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Teléfono</label>
                        <input class="form-control" type="text" name="telefono" required>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">
                        Guardar Estudiante
                    </button>
                </form>

                <?php echo $mensaje_alerta; ?>

            </div>
        </div>

    </div>

</body>

</html>