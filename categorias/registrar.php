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

// 5. PROCESAR EL GUARDADO DE CATEGORÍAS (Se ejecuta en este mismo archivo)
include("../conexion.php");
$mensaje_alerta = ""; // Variable para guardar el mensaje de éxito o error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturamos los 3 campos del formulario de categorías
    $codigo = trim($_POST['codigo']);
    $categoria = trim($_POST['categoria']);
    $descripcion = trim($_POST['descripcion']);

    // CORRECCIÓN: 'categoria' en singular para que coincida con tu Base de Datos
    $sql = "INSERT INTO categoria (codigo, categoria, descripcion) VALUES (?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    // CORRECCIÓN: "iss" porque el código es INT (número entero) en tu script de BD
    $stmt->bind_param("iss", $codigo, $categoria, $descripcion);

    if ($stmt->execute()) {
        // Alerta estética de Bootstrap para éxito
        $mensaje_alerta = '<div class="alert alert-success text-center mt-3 mb-0" role="alert">
                             ¡Categoría Registrada con Éxito!
                           </div>';
    } else {
        // Alerta estética de Bootstrap para error (por si se duplica el código, por ejemplo)
        $mensaje_alerta = '<div class="alert alert-danger text-center mt-3 mb-0" role="alert">
                             Error al registrar la categoría: ' . $conexion->error . '
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
    <title>Registrar Categoría</title>
</head>

<body class="bg-light">

    <div class="container py-5 d-flex justify-content-center">

        <div class="card shadow-sm" style="width: 100%; max-width: 500px;">
            <div class="card-header bg-primary text-white text-center py-3">
                <h3 class="h5 mb-0">📅 Registrar Nueva Categoría</h3>
            </div>

            <div class="card-body p-4">
                <form action="" method="POST">

                    <div class="mb-3">
                        <label class="form-label">Código de la Categoría</label>
                        <input class="form-control" type="number" name="codigo" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre de la Categoría</label>
                        <input class="form-control" type="text" name="categoria" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Descripción</label>
                        <input class="form-control" type="text" name="descripcion" required>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">
                        Guardar Categoría
                    </button>
                </form>

                <?php echo $mensaje_alerta; ?>

            </div>
        </div>

    </div>

</body>

</html>