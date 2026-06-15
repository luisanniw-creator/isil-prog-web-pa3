<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Autor</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="DNI" placeholder="DNI" required>
        <input type="text" name="nombre" placeholder="nombre" required>
        <input type="text" name="nacionalidad" placeholder="telefono" required>
        <button type="submit">
             Guardar
        </button>   
    </form>    
    <?php
       include("../conexion.php");
       if($_POST) {
         $sql="INSERT INTO autores (DNI,nombre,nacionalidad)
          VALUES(?,?,?)";
         $stmt =$conexion->prepare($sql);
         $stmt->bind_param("sss", $_POST['DNI'], $_POST['nombre'], $_POST['nacionalidad']);
         $stmt->execute();
         echo "Autor Registrado con Exito";
       }
     ?> 
</body>
</html>