<?php
// 1. INICIAR SESIÓN
session_start();

// 2. CONTROL DE ACCESO: Si no está logueado, mandarlo al login de la raíz
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php"); // Nota los "../" para salir a la raíz
    exit();
}

// 3. RECUPERAR EL NOMBRE: Así el navbar lo puede pintar correctamente
$usuario = $_SESSION['usuario'];

// 4. AHORA SÍ TRAES EL NAVBAR
include("../navbar.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registrar Estudiante</title>
</head>

<body>
    <form method="POST">
        <input type="text" name="DNI" placeholder="DNI" required>
        <input type="text" name="nombre" placeholder="nombre" required>
        <input type="text" name="nacionalidad" placeholder="nacionalidad" required>
        <button type="submit">
            Guardar
        </button>
    </form>
    <?php
    include("../conexion.php");
    if ($_POST) {
        $sql = "INSERT INTO estudiantes (DNI,nombre,nacionalidad)
          VALUES(?,?,?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sss", $_POST['DNI'], $_POST['nombre'], $_POST['nacionalidad']);
        $stmt->execute();
        echo "Estudiante Registrado con Exito";
    }
    ?>
</body>

</html>