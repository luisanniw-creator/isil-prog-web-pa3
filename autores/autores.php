<?php
include("../sesion.php");
include("../conexion.php");
$ruta = "../";

$mensaje_error = "";

// Eliminar
if (isset($_GET['eliminar'])) {
    try {
        $conexion->prepare("DELETE FROM autores WHERE DNI = ?")->execute([$_GET['eliminar']]);
        header("Location: autores.php");
        exit;
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            $mensaje_error = "⚠️ No se puede eliminar este registro porque tiene datos vinculados en otras tablas. Debes eliminarlos primero.";
        } else {
            $mensaje_error = "Ocurrió un error inesperado: " . $e->getMessage();
        }
    }
}

// Guardar (registrar o modificar)
if ($_POST) {
    if (!empty($_POST['original'])) {
        $sql = "UPDATE autores SET DNI=?, nombre=?, nacionalidad=? WHERE DNI=?";
        $conexion->prepare($sql)->execute([
            $_POST['DNI'],
            $_POST['nombre'],
            $_POST['nacionalidad'],
            $_POST['original']
        ]);
    } else {
        $sql = "INSERT INTO autores (DNI, nombre, nacionalidad) VALUES (?,?,?)";
        $conexion->prepare($sql)->execute([
            $_POST['DNI'],
            $_POST['nombre'],
            $_POST['nacionalidad']
        ]);
    }
    header("Location: autores.php");
    exit;
}

// Cargar datos para editar
$editar = null;
if (isset($_GET['editar'])) {
    $stmt = $conexion->prepare("SELECT * FROM autores WHERE DNI = ?");
    $stmt->execute([$_GET['editar']]);
    $editar = $stmt->fetch();
}

// Listar / Buscar
$buscar = $_GET['buscar'] ?? '';
$stmt = $conexion->prepare("SELECT * FROM autores WHERE nombre LIKE ?");
$stmt->execute(["%$buscar%"]);
$autores = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Autores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include("../navbar.php"); ?>

    <div class="container mt-4">
        <h2>Mantenimiento de Autores</h2>

        <?php if (!empty($mensaje_error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $mensaje_error ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Formulario -->
        <form method="POST" class="row g-2 mb-4">
            <input type="hidden" name="original" value="<?= $editar['DNI'] ?? '' ?>">
            <div class="col-md-3"><input type="number" name="DNI" class="form-control" placeholder="DNI" value="<?= $editar['DNI'] ?? '' ?>" required></div>
            <div class="col-md-3"><input type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?= $editar['nombre'] ?? '' ?>" required></div>
            <div class="col-md-3"><input type="text" name="nacionalidad" class="form-control" placeholder="Nacionalidad" value="<?= $editar['nacionalidad'] ?? '' ?>"></div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success"><?= $editar ? 'Editar' : 'Nuevo' ?></button>
                <a href="autores.php" class="btn btn-secondary">Limpiar</a>
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
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Nacionalidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($autores as $fila) { ?>
                    <tr>
                        <td><?= $fila['DNI'] ?></td>
                        <td><?= $fila['nombre'] ?></td>
                        <td><?= $fila['nacionalidad'] ?></td>
                        <td>
                            <a href="?editar=<?= $fila['DNI'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="?eliminar=<?= $fila['DNI'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar registro?')">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>