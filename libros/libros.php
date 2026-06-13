<?php
include("../sesion.php");
include("../conexion.php");
$ruta = "../";

// Eliminar
if (isset($_GET['eliminar'])) {
    $conexion->prepare("DELETE FROM libros WHERE ID = ?")->execute([$_GET['eliminar']]);
    header("Location: libros.php");
    exit;
}

// Guardar (registrar o modificar)
if ($_POST) {
    if (!empty($_POST['ID'])) {
        $sql = "UPDATE libros SET codigo=?, titulo=?, autor=?, editorial=?, anio=? WHERE ID=?";
        $conexion->prepare($sql)->execute([
            $_POST['codigo'], $_POST['titulo'], $_POST['autor'],
            $_POST['editorial'], $_POST['anio'], $_POST['ID']
        ]);
    } else {
        $sql = "INSERT INTO libros (codigo, titulo, autor, editorial, anio) VALUES (?,?,?,?,?)";
        $conexion->prepare($sql)->execute([
            $_POST['codigo'], $_POST['titulo'], $_POST['autor'],
            $_POST['editorial'], $_POST['anio']
        ]);
    }
    header("Location: libros.php");
    exit;
}

// Cargar datos para editar
$editar = null;
if (isset($_GET['editar'])) {
    $stmt = $conexion->prepare("SELECT * FROM libros WHERE ID = ?");
    $stmt->execute([$_GET['editar']]);
    $editar = $stmt->fetch();
}

// Listar / Buscar
$buscar = $_GET['buscar'] ?? '';
$stmt = $conexion->prepare("SELECT * FROM libros WHERE titulo LIKE ?");
$stmt->execute(["%$buscar%"]);
$libros = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("../navbar.php"); ?>

<div class="container mt-4">
    <h2>Mantenimiento de Libros</h2>

    <!-- Formulario -->
    <form method="POST" class="row g-2 mb-4">
        <input type="hidden" name="ID" value="<?= $editar['ID'] ?? '' ?>">
        <div class="col-md-2"><input type="number" name="codigo" class="form-control" placeholder="Código" value="<?= $editar['codigo'] ?? '' ?>" required></div>
        <div class="col-md-3"><input type="text" name="titulo" class="form-control" placeholder="Título" value="<?= $editar['titulo'] ?? '' ?>" required></div>
        <div class="col-md-2"><input type="text" name="autor" class="form-control" placeholder="Autor" value="<?= $editar['autor'] ?? '' ?>" required></div>
        <div class="col-md-2"><input type="text" name="editorial" class="form-control" placeholder="Editorial" value="<?= $editar['editorial'] ?? '' ?>"></div>
        <div class="col-md-1"><input type="number" name="anio" class="form-control" placeholder="Año" value="<?= $editar['anio'] ?? '' ?>"></div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-success"><?= $editar ? 'Editar' : 'Nuevo' ?></button>
            <a href="libros.php" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    <!-- Buscar -->
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4"><input type="text" name="buscar" class="form-control" placeholder="Buscar por título" value="<?= htmlspecialchars($buscar) ?>"></div>
        <div class="col-md-2"><button type="submit" class="btn btn-primary">Buscar</button></div>
    </form>

    <!-- Tabla -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr><th>Código</th><th>Título</th><th>Autor</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php foreach ($libros as $fila) { ?>
            <tr>
                <td><?= $fila['codigo'] ?></td>
                <td><?= $fila['titulo'] ?></td>
                <td><?= $fila['autor'] ?></td>
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
