<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/estilos.css">
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
        <title>Mi perfil</title>
    </head>
    <body>
        <div id="registro">
            <div class="container">
                <div id="registro-row" class="row justify-content-center align-items-center">
                    <div id="registro-column" class="col-md-6">
                        <div id="registro-box" class="col-md-12">
                            <form id="registro-form" action="<?php echo base_url()?>index.php/EditarController/edit" method="post" id="forma">
                                <h3 class="text-center text-info">Editar perfil</h3>
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="input" name="nombre" class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="correo">Correo:</label>
                                    <input type="email" name="correo" class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="semestre">Semestre:</label>
                                    <input type="input" name="semestre" class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="contrasena">Contraseña:</label>
                                    <input type="password" name="contrasena" class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-info btn-md" value="Guardar" />
                                    <input type="button" name="submit" class="btn btn-danger btn-md" value="Cancelar"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>