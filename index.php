<?php include("navbar.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Veterinaria</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS propio -->
    <link rel="stylesheet" href="css/estilos.css">

    <style>
        body{
            background: #f4f6f9;
        }

        .hero{
            height: 85vh;
            display:flex;
            justify-content:center;
            align-items:center;
            text-align:center;
        }

        .card-opcion{
            transition:0.3s;
            border:none;
            border-radius:20px;
            overflow:hidden;
        }

        .card-opcion:hover{
            transform:translateY(-10px);
            box-shadow:0px 10px 25px rgba(0,0,0,0.2);
        }

        .icono{
            font-size:60px;
        }
    </style>
</head>
<body>

<div class="container hero">
    <div class="row g-4">

        <!-- Mascotas -->
        <div class="col-md-6">
            <div class="card card-opcion shadow-lg">
                <div class="card-body p-5">
                    <div class="icono">🐶</div>
                    <h2 class="mt-3">Módulo Mascotas</h2>
                    <p>Registro y listado de mascotas.</p>

                    <a href="mascotas/registrar.php" class="btn btn-success">
                        Registrar Mascota
                    </a>

                    <a href="mascotas/listar.php" class="btn btn-dark">
                        Listar Mascotas
                    </a>
                </div>
            </div>
        </div>

        <!-- Citas -->
        <div class="col-md-6">
            <div class="card card-opcion shadow-lg">
                <div class="card-body p-5">
                    <div class="icono">📅</div>
                    <h2 class="mt-3">Módulo Citas</h2>
                    <p>Gestión y control de citas veterinarias.</p>

                    <a href="citas/registrar.php" class="btn btn-primary">
                        Registrar Cita
                    </a>

                    <a href="citas/listar.php" class="btn btn-dark">
                        Listar Citas
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>