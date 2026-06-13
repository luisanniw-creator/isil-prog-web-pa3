<?php
include("../conexion.php");
 $sql =$conexion->query("SELECT * FROM DUEÑOS");
?>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Dueño</th>
        <th>Telefono</th>
        <th>Direccion</th>
    </tr>    
    <?php while($fila=$sql->fetch()){?>
      <tr>
        <td><?=$fila['id']?></td>
        <td><?=$fila['nombre']?></td>
        <td><?=$fila['telefono']?></td>
        <td><?=$fila['direccion']?></td>
      </tr> 
    <?php }?>
</table>     