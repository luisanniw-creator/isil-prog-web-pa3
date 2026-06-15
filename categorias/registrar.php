<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Categoría</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="codigo" placeholder="codigo">
        <input type="text" name="categoria" placeholder="categoria">
        <input type="text" name="descripcion" placeholder="descripcion">
        <select name="libro_id">
            <?php
              include("../conexion.php");
              $sql =$conexion->query("SELECT * FROM libros ");
              while ($fila =$sql->fetch_assoc()) {
             ?>
               <option value="<?=$fila["id"]?>">
                  <?=$fila["nombre"]?>
                  <?=$fila["categoria"]?>
                   <?=$fila["descripcion"]?>
                </option>
              <?php }?>     
       </select>    
       </form>    
    
</body>
</html>