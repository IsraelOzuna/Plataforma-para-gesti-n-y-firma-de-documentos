<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <title>Página principal</title>
  </head>
  <body>
    <div class="container">
      <h2 class="text">Alumnos en el pafi</h2>
      <table class="table table-striped table-bordered" id="tablaAlumnos">
        <thead class=thead-dark>
          <th scope="col">Matricula</th>
          <th scope="col">Nombre</th>
          <th scope="col">Correo</th>
          <th scope="col">Semestre</th>
        </thead>
        <?php foreach ($alumnos as $alumno): ?>
        <tr>
          <td>
            <?php echo $alumno['matricula'];?>
          </td>
          <td>
            <?php echo $alumno['nombre'];?>
          </td>
          <td>
            <?php echo $alumno['correo'];?>
          </td>
          <td>
            <?php echo $alumno['semestre'];?>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </body>
</html>