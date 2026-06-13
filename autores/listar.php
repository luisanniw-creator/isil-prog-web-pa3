<?php
include("../conexion.php");
 $sql =$conexion->query("SELECT * FROM autores");
?>
<table border="1">
    <tr>
        <th>DNI</th>
        <th>Nombre</th>
        <th>Nacionalidad</th>
    </tr>    
    <?php while($fila=$sql->fetch()){?>
      <tr>
        <td><?=$fila['DNI']?></td>
        <td><?=$fila['nombre']?></td>
        <td><?=$fila['nacionalidad']?></td>
      </tr> 
    <?php }?>
</table>     