<?php
include("../conexion.php");
 $sql =$conexion->query("SELECT * FROM categoria");
?>
<table border="1">
    <tr>
        <th>Codigo</th>
        <th>Categoria</th>
        <th>Descripcion</th>
    </tr>    
    <?php while($fila=$sql->fetch_assoc()){?>
      <tr>
        <td><?=$fila['codigo']?></td>
        <td><?=$fila['categoria']?></td>
        <td><?=$fila['descripcion']?></td>
      </tr> 
    <?php }?>
</table>     