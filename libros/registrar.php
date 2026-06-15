<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registrar Libro</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="titulo" placeholder="titulo" required>
        <input type="text" name="autor" placeholder="autor" required>
        <input type="text" name="nacionalidad" placeholder="nacionalidad" required>
        <button type="submit">
             Guardar
        </button>   
    </form>    
    <?php
       include("../conexion.php");
       if($_POST) {
         $sql="INSERT INTO libros (titulo,autor,nacionalidad)
          VALUES(?,?,?)";
         $stmt =$conexion->prepare($sql);
         $stmt->bind_param("sss", $_POST['titulo'], $_POST['autor'], $_POST['nacionalidad']);
         $stmt->execute();
         echo "Libro Registrado con Exito";
       }
     ?> 
</body>
</html>


