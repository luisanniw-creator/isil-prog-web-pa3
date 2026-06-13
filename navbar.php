<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">
            🏥 Veterinaria
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">

            <ul class="navbar-nav ms-auto">

                <!-- Mascotas -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Mascotas
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="mascotas/registrar.php">
                                Registrar
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="mascotas/listar.php">
                                Listar
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Citas -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Citas
                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="citas/registrar.php">
                                Registrar
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="citas/listar.php">
                                Listar
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>

        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>