<?php
include("../sesion.php");
include("../conexion.php");
$ruta = "../";

// Eliminar
if (isset($_GET['eliminar'])) {
    $conexion->prepare("DELETE FROM editoriales WHERE RUC = ?")->execute([$_GET['eliminar']]);
    header("Location: editoriales.php");
    exit;
}

// Guardar (registrar o modificar)
if ($_POST) {
    if (!empty($_POST['original'])) {
        $sql = "UPDATE editoriales SET RUC=?, nombre_Editorial=?, direccion=?, telefono=? WHERE RUC=?";
        $conexion->prepare($sql)->execute([
            $_POST['RUC'], $_POST['nombre'], $_POST['direccion'], $_POST['telefono'], $_POST['original']
        ]);
    } else {
        $sql = "INSERT INTO editoriales (RUC, nombre_Editorial, direccion, telefono) VALUES (?,?,?,?)";
        $conexion->prepare($sql)->execute([
            $_POST['RUC'], $_POST['nombre'], $_POST['direccion'], $_POST['telefono']
        ]);
    }
    header("Location: editoriales.php");
    exit;
}

// Cargar datos para editar
$editar = null;
if (isset($_GET['editar'])) {
    $stmt = $conexion->prepare("SELECT * FROM editoriales WHERE RUC = ?");
    $stmt->execute([$_GET['editar']]);
    $editar = $stmt->fetch();
}

// Listar / Buscar
$buscar = $_GET['buscar'] ?? '';
$stmt = $conexion->prepare("SELECT * FROM editoriales WHERE nombre_Editorial LIKE ?");
$stmt->execute(["%$buscar%"]);
$editoriales = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editoriales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("../navbar.php"); ?>

<div class="container mt-4">
    <h2>Mantenimiento de Editoriales</h2>

    <!-- Formulario -->
    <form method="POST" class="row g-2 mb-4">
        <input type="hidden" name="original" value="<?= $editar['RUC'] ?? '' ?>">
        <div class="col-md-2"><input type="number" name="RUC" class="form-control" placeholder="RUC" value="<?= $editar['RUC'] ?? '' ?>" required></div>
        <div class="col-md-3"><input type="text" name="nombre" class="form-control" placeholder="Nombre Editorial" value="<?= $editar['nombre_Editorial'] ?? '' ?>" required></div>
        <div class="col-md-3"><input type="text" name="direccion" class="form-control" placeholder="Dirección" value="<?= $editar['direccion'] ?? '' ?>"></div>
        <div class="col-md-2"><input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="<?= $editar['telefono'] ?? '' ?>"></div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success"><?= $editar ? 'Editar' : 'Nuevo' ?></button>
            <a href="editoriales.php" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    <!-- Buscar -->
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4"><input type="text" name="buscar" class="form-control" placeholder="Buscar por editorial" value="<?= htmlspecialchars($buscar) ?>"></div>
        <div class="col-md-2"><button type="submit" class="btn btn-primary">Buscar</button></div>
    </form>

    <!-- Tabla -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr><th>RUC</th><th>Editorial</th><th>Teléfono</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php foreach ($editoriales as $fila) { ?>
            <tr>
                <td><?= $fila['RUC'] ?></td>
                <td><?= $fila['nombre_Editorial'] ?></td>
                <td><?= $fila['telefono'] ?></td>
                <td>
                    <a href="?editar=<?= $fila['RUC'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="?eliminar=<?= $fila['RUC'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar registro?')">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
