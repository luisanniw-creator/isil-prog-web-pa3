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

// 5. PROCESAR EL GUARDADO DE AUTORES (Se ejecuta en este mismo archivo)
include("../conexion.php");
$mensaje_alerta = ""; // Variable para guardar el mensaje de éxito o error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturamos los campos del formulario de autores
    $dni = trim($_POST['DNI']);
    $nombre = trim($_POST['nombre']);
    $nacionalidad = trim($_POST['nacionalidad']);

    // Consulta SQL dirigida a la tabla 'autores'
    $sql = "INSERT INTO autores (DNI, nombre, nacionalidad) VALUES (?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    // "sss" significa: 3 strings (textos) correspondientes a DNI, nombre y nacionalidad
    $stmt->bind_param("sss", $dni, $nombre, $nacionalidad);

    if ($stmt->execute()) {
        // Alerta estética de Bootstrap para éxito
        $mensaje_alerta = '<div class="alert alert-success text-center mt-3 mb-0" role="alert">
                             ¡Autor Registrado con Éxito!
                           </div>';
    } else {
        // Alerta estética de Bootstrap para error (por si se duplica un DNI primario, por ejemplo)
        $mensaje_alerta = '<div class="alert alert-danger text-center mt-3 mb-0" role="alert">
                             Error al registrar el autor: ' . $conexion->error . '
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
    <title>Registrar Autor</title>
</head>

<body class="bg-light">

    <div class="container py-5 d-flex justify-content-center">

        <div class="card shadow-sm" style="width: 100%; max-width: 500px;">
            <div class="card-header bg-primary text-white text-center py-3">
                <h3 class="h5 mb-0">👤 Registrar Nuevo Autor</h3>
            </div>

            <div class="card-body p-4">
                <form action="" method="POST">

                    <div class="mb-3">
                        <label class="form-label">DNI / Documento de Identidad</label>
                        <input class="form-control" type="text" name="DNI" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input class="form-control" type="text" name="nombre" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Nacionalidad</label>
                        <input class="form-control" type="text" name="nacionalidad" required>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">
                        Guardar Autor
                    </button>
                </form>

                <?php echo $mensaje_alerta; ?>

            </div>
        </div>

    </div>
</body>

</html>