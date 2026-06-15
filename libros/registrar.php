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

// 4. NAVBAR
include("../navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registrar Libro</title>
</head>

<body>
    <div class="card shadow">
        <div class="card-header bg-primary">
            <h3>Registrar Libro</h3>
        </div>
        <div class="card-body">
            <form action="guardar.php" method="POST">
                <input class="form-control mb-3" type="text" name="titulo" placeholder="Título" required>
                <input class="form-control mb-3" type="text" name="autor" placeholder="Autor" required>
                <input class="form-control mb-3" type="text" name="nacionalidad" placeholder="Nacionalidad" required>
                <button class="btn btn-primary" type="submit">
                    Guardar
                </button>
            </form>
        </div>
    </div>
    <?php
    include("../conexion.php");
    if ($_POST) {
        $sql = "INSERT INTO libros (titulo,autor,nacionalidad)
          VALUES(?,?,?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sss", $_POST['titulo'], $_POST['autor'], $_POST['nacionalidad']);
        $stmt->execute();
        echo "Libro Registrado con Exito";
    }
    ?>
</body>

</html>