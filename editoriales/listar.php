<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: ../login.php");
  exit();
}
$usuario = $_SESSION['usuario'];
include("../conexion.php");
$buscar = isset($_GET['buscar']) ? trim($_GET['buscar']) : "";
$sql = $buscar != "" ? $conexion->query("SELECT * FROM editoriales WHERE nombre_Editorial LIKE '%$buscar%' OR RUC LIKE '%$buscar%'") : $conexion->query("SELECT * FROM editoriales");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Listado Editoriales</title>
</head>

<body class="bg-light"><?php include("../navbar.php"); ?>
  <div class="container py-5">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
        <h3 class="h5 mb-0">🏢 Listado de Editoriales</h3><a href="registrar.php" class="btn btn-success btn-sm">➕ Nueva Editorial</a>
      </div>
      <div class="card-body p-4">
        <form action="" method="GET" class="row g-2 mb-4">
          <div class="col-10"><input class="form-control" type="text" name="buscar" value="<?= htmlspecialchars($buscar) ?>" required></div>
          <div class="col-2 col-md-2"><button type="submit" class="btn btn-secondary w-100">Buscar</button></div>
          <?php if ($buscar != ""): ?><div class="col-12 col-md-2"><a href="listar.php" class="btn btn-outline-dark w-100">Limpiar</a></div><?php endif; ?>
        </form>
        <table class="table table-striped table-hover table-bordered align-middle mb-0">
          <thead class="text-center">
            <tr>
              <th>RUC</th>
              <th>Editorial</th>
              <th>Teléfono</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($sql->num_rows > 0) {
              while ($fila = $sql->fetch_assoc()) { ?>
                <tr>
                  <td class="text-center"><?= $fila['RUC'] ?></td>
                  <td><?= htmlspecialchars($fila['nombre_Editorial']) ?></td>
                  <td><?= htmlspecialchars($fila['telefono']) ?></td>
                  <td class="text-center" style="width: 180px;">
                    <a href="editar.php?ruc=<?= $fila['RUC'] ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                    <a href="borrar.php?ruc=<?= $fila['RUC'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Borrar editorial?');">🗑️ Borrar</a>
                  </td>
                </tr>
            <?php }
            } else {
              echo '<tr><td colspan="4" class="text-center py-3">No hay registros.</td></tr>';
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>