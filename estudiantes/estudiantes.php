<?php
include("../sesion.php");
include("../conexion.php");
$ruta = "../";

// Eliminar
if (isset($_GET['eliminar'])) {
    $conexion->prepare("DELETE FROM estudiantes WHERE codigo = ?")->execute([$_GET['eliminar']]);
    header("Location: estudiantes.php");
    exit;
}

// Guardar (registrar o modificar)
if ($_POST) {
    if (!empty($_POST['original'])) {
        $sql = "UPDATE estudiantes SET codigo=?, nombre=?, apellido=?, carrera=?, telefono=? WHERE codigo=?";
        $conexion->prepare($sql)->execute([
            $_POST['codigo'], $_POST['nombre'], $_POST['apellido'],
            $_POST['carrera'], $_POST['telefono'], $_POST['original']
        ]);
    } else {
        $sql = "INSERT INTO estudiantes (codigo, nombre, apellido, carrera, telefono) VALUES (?,?,?,?,?)";
        $conexion->prepare($sql)->execute([
            $_POST['codigo'], $_POST['nombre'], $_POST['apellido'],
            $_POST['carrera'], $_POST['telefono']
        ]);
    }
    header("Location: estudiantes.php");
    exit;
}

// Cargar datos para editar
$editar = null;
if (isset($_GET['editar'])) {
    $stmt = $conexion->prepare("SELECT * FROM estudiantes WHERE codigo = ?");
    $stmt->execute([$_GET['editar']]);
    $editar = $stmt->fetch();
}

// Listar / Buscar
$buscar = $_GET['buscar'] ?? '';
$stmt = $conexion->prepare("SELECT * FROM estudiantes WHERE nombre LIKE ?");
$stmt->execute(["%$buscar%"]);
$estudiantes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudiantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("../navbar.php"); ?>

<div class="container mt-4">
    <h2>Mantenimiento de Estudiantes</h2>

    <!-- Formulario -->
    <form method="POST" class="row g-2 mb-4">
        <input type="hidden" name="original" value="<?= $editar['codigo'] ?? '' ?>">
        <div class="col-md-2"><input type="number" name="codigo" class="form-control" placeholder="Código" value="<?= $editar['codigo'] ?? '' ?>" required></div>
        <div class="col-md-2"><input type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?= $editar['nombre'] ?? '' ?>" required></div>
        <div class="col-md-2"><input type="text" name="apellido" class="form-control" placeholder="Apellidos" value="<?= $editar['apellido'] ?? '' ?>"></div>
        <div class="col-md-2"><input type="text" name="carrera" class="form-control" placeholder="Carrera" value="<?= $editar['carrera'] ?? '' ?>"></div>
        <div class="col-md-2"><input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="<?= $editar['telefono'] ?? '' ?>"></div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success"><?= $editar ? 'Editar' : 'Nuevo' ?></button>
            <a href="estudiantes.php" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    <!-- Buscar -->
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4"><input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre" value="<?= htmlspecialchars($buscar) ?>"></div>
        <div class="col-md-2"><button type="submit" class="btn btn-primary">Buscar</button></div>
    </form>

    <!-- Tabla -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr><th>Código</th><th>Nombre</th><th>Carrera</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php foreach ($estudiantes as $fila) { ?>
            <tr>
                <td><?= $fila['codigo'] ?></td>
                <td><?= $fila['nombre'] ?></td>
                <td><?= $fila['carrera'] ?></td>
                <td>
                    <a href="?editar=<?= $fila['codigo'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="?eliminar=<?= $fila['codigo'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar registro?')">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
