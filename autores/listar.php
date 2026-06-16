<?php
// 1. INICIAR SESIÓN Y CONTROL DE ACCESO
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: ../login.php");
  exit();
}
$usuario = $_SESSION['usuario'];

// 2. NAVBAR Y CONEXIÓN
include("../navbar.php");
include("../conexion.php");

// 3. LÓGICA DE BÚSQUEDA
// Si el usuario escribe algo en el buscador, filtramos; si no, listamos todo.
$buscar = "";
if (isset($_GET['buscar'])) {
  $buscar = trim($_GET['buscar']);
  // Buscamos coincidencia en el nombre o en el DNI del autor
  $sql = $conexion->query("SELECT * FROM autores WHERE nombre LIKE '%$buscar%' OR DNI LIKE '%$buscar%'");
} else {
  $sql = $conexion->query("SELECT * FROM autores");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/estilos.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Listado de Autores</title>
</head>

<body class="bg-light">

  <div class="container py-5">

    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
        <h3 class="h5 mb-0">👤 Listado de Autores Registrados</h3>
        <a href="registrar.php" class="btn btn-success btn-sm">➕ Registrar Nuevo Autor</a>
      </div>

      <div class="card-body p-4">

        <form action="" method="GET" class="row g-2 mb-4">
          <div class="col-10">
            <input class="form-control" type="text" name="buscar" value="<?php echo htmlspecialchars($buscar); ?>" required>
          </div>
          <div class="col-2 col-md-2">
            <button type="submit" class="btn btn-secondary w-100">Buscar</button>
          </div>
          <?php if (isset($_GET['buscar'])): ?>
            <div class="col-12 col-md-2">
              <a href="listar.php" class="btn btn-outline-dark w-100">Limpiar</a>
            </div>
          <?php endif; ?>
        </form>

        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered align-middle mb-0">
            <thead class="text-center">
              <tr>
                <th>DNI</th>
                <th>Nombre Completo</th>
                <th>Nacionalidad</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($sql->num_rows > 0) {
                while ($fila = $sql->fetch_assoc()) {
              ?>
                  <tr>
                    <td class="text-center"><?= $fila['DNI'] ?></td>
                    <td><?= $fila['nombre'] ?></td>
                    <td><?= $fila['nacionalidad'] ?></td>
                    <td class="text-center" style="width: 180px;">
                      <a href="editar.php?dni=<?= $fila['DNI'] ?>" class="btn btn-warning btn-sm">
                        ✏️ Editar
                      </a>
                      <a href="borrar.php?dni=<?= $fila['DNI'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este autor?');">
                        🗑️ Borrar
                      </a>
                    </td>
                  </tr>
                <?php
                }
              } else {
                ?>
                <tr>
                  <td colspan="4" class="text-center text-muted py-3">No se encontraron autores en la base de datos.</td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>

  </div>

</body>

</html>