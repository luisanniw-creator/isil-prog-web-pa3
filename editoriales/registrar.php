<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Editoriales</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="RUC" placeholder="RUC">
        <input type="text" name="nombre_Editorial" placeholder="nombre">
        <input type="text" name="direccion" placeholder="especie">
        <input type="text" name="telefono" placeholder="raza">
        <select name="dueño_id">
            <?php
              include("../conexion.php");
              $sql =$conexion->query("SELECT * FROM editoriales");
              while ($fila =$sql->fetch_assoc()) {
             ?>
               <option value="<?=$fila["id"]?>">
                  <?=$fila["RUC"]?>
                    <?=$fila["nombre_Editorial"]?>
                   <?=$fila["direccion"]?>
                    <?=$fila["telefono"]?>
                </option>
              <?php }?>     
       </select>    
       </form>    
    
</body>
</html>