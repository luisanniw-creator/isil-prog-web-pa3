<?php
include("../conexion.php");
 $sql =$conexion->query("SELECT * FROM estudiantes");
?>
<table border="1">
    <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Carrera</th>
        <th>Telefono</th>
    </tr>    
    <?php while($fila=$sql->fetch_assoc()){?>
      <tr>
        <td><?=$fila['codigo']?></td>
        <td><?=$fila['nombre']?></td>
        <td><?=$fila['apellido']?></td>
        <td><?=$fila['carrera']?></td>
        <td><?=$fila['telefono']?></td>
      </tr> 
    <?php }?>
</table>     