<?php
include("../conexion.php");
 $sql =$conexion->query("SELECT * FROM editoriales");
?>
<table border="1">
    <tr>
        <th>RUC</th>
        <th>Nombre Editorial</th>
        <th>Dirección</th>
        <th>Telefono</th>
    </tr>    
    <?php while($fila=$sql->fetch_assoc()){?>
      <tr>
        <td><?=$fila['RUC']?></td>
        <td><?=$fila['nombre_Editorial']?></td>
        <td><?=$fila['direccion']?></td>
        <td><?=$fila['telefono']?></td>
      </tr> 
    <?php }?>
</table>     