<?php
// $ruta permite que los enlaces funcionen desde la raíz ("") o desde una subcarpeta ("../")
$ruta = isset($ruta) ? $ruta : "";
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand fw-bold" href="<?= $ruta ?>index.php">
            📚 Biblioteca "El Saber"
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $ruta ?>index.php">🏠 Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $ruta ?>libros/libros.php">📚 Libros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $ruta ?>autores/autores.php">👤 Autores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $ruta ?>editoriales/editoriales.php">🏢 Editoriales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $ruta ?>estudiantes/estudiantes.php">🎓 Estudiantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $ruta ?>categorias/categorias.php">📖 Categorías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning" href="<?= $ruta ?>logout.php">🚪 Salir</a>
                </li>
            </ul>

        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
