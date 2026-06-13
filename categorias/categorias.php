<?php
include("../sesion.php");
include("../conexion.php");
$ruta = "../";

// Eliminar
if (isset($_GET['eliminar'])) {
    $conexion->prepare("DELETE FROM categoria WHERE codigo = ?")->execute([$_GET['eliminar']]);
    header("Location: categorias.php");
    exit;
}

// Guardar (registrar o modificar)
if ($_POST) {
    if (!empty($_POST['original'])) {
        $sql = "UPDATE categoria SET codigo=?, categoria=?, descripcion=? WHERE codigo=?";
        $conexion->prepare($sql)->execute([
            $_POST['codigo'], $_POST['categoria'], $_POST['descripcion'], $_POST['original']
        ]);
    } else {
        $sql = "INSERT INTO categoria (codigo, categoria, descripcion) VALUES (?,?,?)";
        $conexion->prepare($sql)->execute([
            $_POST['codigo'], $_POST['categoria'], $_POST['descripcion']
        ]);
    }
    header("Location: categorias.php");
    exit;
}

// Cargar datos para editar
$editar = null;
if (isset($_GET['editar'])) {
    $stmt = $conexion->prepare("SELECT * FROM categoria WHERE codigo = ?");
    $stmt->execute([$_GET['editar']]);
    $editar = $stmt->fetch();
}

// Listar / Buscar
$buscar = $_GET['buscar'] ?? '';
$stmt = $conexion->prepare("SELECT * FROM categoria WHERE categoria LIKE ?");
$stmt->execute(["%$buscar%"]);
$categorias = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("../navbar.php"); ?>

<div class="container mt-4">
    <h2>Mantenimiento de Categorías</h2>

    <!-- Formulario -->
    <form method="POST" class="row g-2 mb-4">
        <input type="hidden" name="original" value="<?= $editar['codigo'] ?? '' ?>">
        <div class="col-md-2"><input type="number" name="codigo" class="form-control" placeholder="Código" value="<?= $editar['codigo'] ?? '' ?>" required></div>
        <div class="col-md-3"><input type="text" name="categoria" class="form-control" placeholder="Categoría" value="<?= $editar['categoria'] ?? '' ?>" required></div>
        <div class="col-md-4"><input type="text" name="descripcion" class="form-control" placeholder="Descripción" value="<?= $editar['descripcion'] ?? '' ?>"></div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-success"><?= $editar ? 'Editar' : 'Nuevo' ?></button>
            <a href="categorias.php" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    <!-- Buscar -->
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4"><input type="text" name="buscar" class="form-control" placeholder="Buscar por categoría" value="<?= htmlspecialchars($buscar) ?>"></div>
        <div class="col-md-2"><button type="submit" class="btn btn-primary">Buscar</button></div>
    </form>

    <!-- Tabla -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr><th>Código</th><th>Categoría</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $fila) { ?>
            <tr>
                <td><?= $fila['codigo'] ?></td>
                <td><?= $fila['categoria'] ?></td>
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
