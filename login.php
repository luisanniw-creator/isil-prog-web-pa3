<?php
session_start();

if (!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = 0;
}

include("conexion.php");

$mensaje = "";

if (isset($_POST['ingresar'])) {

    $usuario = trim($_POST['usuario']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {

        $fila = $resultado->fetch_assoc();

        if (password_verify($password, $fila['password'])) {

            $_SESSION['usuario'] = $fila['usuario'];
            $_SESSION['intentos'] = 0;

            $mensaje = "
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Bienvenido',
                text: '{$fila['usuario']}'
            }).then(() => {
                window.location='index.php';
            });
            </script>";
        } else {
            $_SESSION['intentos']++;
        }

    } else {
        $_SESSION['intentos']++;
    }

    if (!empty($_SESSION['intentos']) && $_SESSION['intentos'] > 0 && empty($mensaje)) {

        if ($_SESSION['intentos'] >= 3) {

            $mensaje = "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Acceso bloqueado',
                text: 'Has superado los 3 intentos permitidos'
            });
            </script>";

        } else {

            $restantes = 3 - $_SESSION['intentos'];

            $mensaje = "
            <script>
            Swal.fire({
                icon: 'warning',
                title: 'Error',
                text: 'Usuario o contraseña incorrectos. Intentos restantes: $restantes'
            });
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body{
    font-family: Arial, sans-serif;
    margin:50px;
}
input{
    padding:8px;
    margin:5px 0;
}
</style>

</head>
<body>
<img src="img/logo.jpg" alt="Logo" class="img-fluid" width="100">
<h2 class="title">Iniciar Sesión</h2>

<?php
echo $mensaje;
?>

<?php if ($_SESSION['intentos'] < 3) { ?>

<form method="POST">

    <input type="text" name="usuario" placeholder="Usuario" required>
    <br>

    <input type="password" name="password" placeholder="Contraseña" required>
    <br>

    <button type="submit" name="ingresar">
        Ingresar
    </button>

</form>

<?php } else { ?>

<h3>Cuenta bloqueada por exceso de intentos.</h3>

<?php } ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
