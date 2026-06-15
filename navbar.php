<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container d-flex justify-content-around">

        <a class="navbar-brand fw-bold" href="/isil-prog-web-pa3/index.php">
            📚 Biblioteca LOFC
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Libros
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/isil-prog-web-pa3/libros/registrar.php">
                                Registrar
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/isil-prog-web-pa3/libros/listar.php">
                                Listar
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Autores
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/isil-prog-web-pa3/autores/registrar.php">
                                Registrar
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/isil-prog-web-pa3/autores/listar.php">
                                Listar
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Editoriales
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/isil-prog-web-pa3/editoriales/registrar.php">
                                Registrar
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/isil-prog-web-pa3/editoriales/listar.php">
                                Listar
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Estudiantes
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/isil-prog-web-pa3/estudiantes/registrar.php">
                                Registrar
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/isil-prog-web-pa3/estudiantes/listar.php">
                                Listar
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Categorias
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="/isil-prog-web-pa3/categorias/registrar.php">
                                Registrar
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="/isil-prog-web-pa3/categorias/listar.php">
                                Listar
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>

        <div class="d-flex align-items-center mt-3 mt-lg-0 mx-2">
            <span class="navbar-text text-white me-3">
                <i class="fas fa-user-circle me-2"></i>
                <?= isset($usuario) ? $usuario : 'Invitado' ?>
            </span>

            <a href="/isil-prog-web-pa3/logout.php" class="btn btn-danger btn-sm">
                <i class="fas fa-sign-out-alt"></i> Salir
            </a>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>