<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Dueño</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="nombre" placeholder="nombre" required>
        <input type="text" name="telefono" placeholder="telefono" required>
        <input type="text" name="direccion" placeholder="direccion">
        <button type="submit">
             Guardar
        </button>   
    </form>    
    <?php
       include("../conexion.php");
       if($_POST) {
         $sql="INSERT INTO dueños (nombre,telefono,direccion)
          VALUES(?,?,?)";
         $stmt =$conexion->prepare($sql);
         $stmt ->execute([
            $_POST['nombre'],
            $_POST['telefono'],
            $_POST['direccion'],
         ]);
         echo "Dueño Registrado con Exito";
       }
     ?> 
</body>
</html>