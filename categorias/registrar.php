<?php
include("../conexion.php");
 $sql =$conexion->query("SELECT * FROM categorias");

// Eliminar
if (isset($_GET['eliminar'])) {
    $conexion->prepare("DELETE FROM categorias WHERE ID = ?")->execute([$_GET['eliminar']]);
    header("Location: categorias.php");
    exit;
}

// Guardar (registrar o modificar)
if ($_POST) {
    if (!empty($_POST['ID'])) {
        $sql = "UPDATE categorias SET nombre=?, descripcion=? WHERE ID=?";
        $conexion->prepare($sql)->execute([
            $_POST['nombre'], $_POST['descripcion'], $_POST['ID']
        ]);
    } else {
        $sql = "INSERT INTO categorias (nombre, descripcion) VALUES (?,?)";
        $conexion->prepare($sql)->execute([
            $_POST['nombre'], $_POST['descripcion']
        ]);
    }
    header("Location:categorias.php");
    exit;
}

// Cargar datos para editar
$editar = null;
if (isset($_GET['editar'])) {
    $stmt = $conexion->prepare("SELECT * FROM categorias WHERE ID = ?");
    $stmt->execute([$_GET['editar']]);
    $editar = $stmt->fetch_assoc();
}

// Listar / Buscar
$buscar = $_GET['buscar'] ?? '';
$stmt = $conexion->prepare("SELECT * FROM categorias WHERE nombre LIKE ? OR descripcion LIKE ?");
$like = "%$buscar%";
$stmt->bind_param("ss", $like, $like);
$stmt->execute();
$result = $stmt->get_result();
$libros = $result->fetch_all();
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
        <input type="hidden" name="ID" value="<?= $editar['ID'] ?? '' ?>">
        <div class="col-md-3"><input type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?= $editar['nombre'] ?? '' ?>" required></div>
        <div class="col-md-6"><input type="text" name="descripcion" class="form-control" placeholder="Descripción" value="<?= $editar['descripcion'] ?? '' ?>" required></div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success"><?= $editar ? 'Editar' : 'Nuevo' ?></button>
            <a href="categorias.php" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    <!-- Buscar -->
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4"><input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o descripción" value="<?= htmlspecialchars($buscar) ?>"></div>
        <div class="col-md-2"><button type="submit" class="btn btn-primary">Buscar</button></div>
    </form>

    <!-- Tabla -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr><th>Código</th><th>Nombre</th><th>Descripción</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php foreach ($libros as $fila) { ?>
            <tr>
                <td><?= $fila['codigo'] ?></td>
                <td><?= $fila['nombre'] ?></td>
                <td><?= $fila['descripcion'] ?></td>
                <td>
                    <a href="?editar=<?= $fila['ID'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="?eliminar=<?= $fila['ID'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar registro?')">Eliminar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>