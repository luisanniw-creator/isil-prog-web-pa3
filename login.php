<?php
session_start();
include("conexion.php");

$error = "";

if ($_POST) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $sql = $conexion->prepare("SELECT * FROM usuario WHERE usuario = ? AND contrasena = ?");
    $sql->execute([$usuario, $contrasena]);
    $fila = $sql->fetch();

    if ($fila) {
        $_SESSION['usuario'] = $fila['usuario'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biblioteca El Saber</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background:#f4f6f9;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .login-card{
            border:none;
            border-radius:20px;
            width:380px;
        }
        .logo{
            font-size:70px;
        }
    </style>
</head>
<body>

<div class="card login-card shadow-lg">
    <div class="card-body p-5 text-center">

        <div class="logo">📚</div>
        <h3 class="mb-4">Biblioteca "El Saber"</h3>

        <?php if ($error) { ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php } ?>

        <form method="POST">
            <div class="mb-3 text-start">
                <label class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control" required>
            </div>

            <div class="mb-3 text-start">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>

    </div>
</div>

</body>
</html>
