<?php
include("../conexion.php");
 $sql =$conexion->query("SELECT * FROM estudiantes");
?>
<table class="table table-bordered">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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