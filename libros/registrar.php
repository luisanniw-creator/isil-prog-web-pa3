<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Mascotas</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="nombre" placeholder="nombre">
        <input type="text" name="especie" placeholder="especie">
        <input type="text" name="raza" placeholder="raza">
        <input type="number" name="edad" placeholder="edad">
        <select name="dueño_id">
            <?php
              include("../conexion.php");
              $sql =$conexion->query("SELECT * FROM DUEÑOS");
              while ($fila =$sql->fetch()) {
             ?>
               <option value="<?=$fila["id"]?>">
                  <?=$fila["nombre"]?>
                </option>
              <?php }?>     
       </select>    
       </form>    
    
</body>
</html>