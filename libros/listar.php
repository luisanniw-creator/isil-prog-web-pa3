<?php
include("../conexion.php");
 $sql =$conexion->query("SELECT * FROM libros");
?>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Codigo</th>
        <th>titulo</th>
        <th>Editorial</th>
        <th>Fecha</th>
        <th>Autor</th>
    </tr>    
    <?php while($fila=$sql->fetch_assoc()){?>
      <tr>
        <td><?=$fila['ID']?></td>
        <td><?=$fila['codigo']?></td>
        <td><?=$fila['titulo']?></td>
        <td><?=$fila['editorial']?></td>
        <td><?=$fila['fecha']?></td>
        <td><?=$fila['autor']?></td>
      </tr> 
    <?php }?>
</table>     