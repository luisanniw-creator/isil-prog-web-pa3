<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Estudiantes</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="codigo" placeholder="codigo">
        <input type="text" name="nombre" placeholder="nombre">
        <input type="text" name="apellido" placeholder="apellido">
        <input type="text" name="carrera" placeholder="carrera">
        <input type="number" name="telefono" placeholder="telefono">
        <select name="libro_id">
            <?php
              include("../conexion.php");
              $sql =$conexion->query("SELECT * FROM estudiantes");
              while ($fila =$sql->fetch_assoc()) {
             ?>
               <option value="<?=$fila["id"]?>">
                  <?=$fila["codigo"]?>
                  <?=$fila["nombre"]?>
                  <?=$fila["apellido"]?>
                  <?=$fila["carrera"]?>
                  <?=$fila["telefono"]?>

                </option>
              <?php }?>     
       </select>    
       </form>    
    
</body>
</html>