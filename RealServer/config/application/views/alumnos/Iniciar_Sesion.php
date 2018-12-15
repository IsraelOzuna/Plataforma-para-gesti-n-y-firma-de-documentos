<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/estilos.css">
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
        <title>Iniciar sesión</title>
    </head>
    <body>
        <div id="login">
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" method="post" action="<?php echo base_url()?>index.php/IniciarSesionController/iniciar">
                                <h3 class="text-center text-info">Iniciar sesión</h3>
                                <div class="form-group">
                                    <label for="Matricula" class="text-info">Matricula:</label><br>
                                    <input type="text" name="matricula" class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <label for="Contrasena" class="text-info">Contraseña:</label><br>
                                    <input type="password" name="contrasena" class="form-control" required="true">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-info btn-md " value="Iniciar">
                                </div>
                                <div id="registro-link" class="text-right">
                                    <a href="<?php echo base_url()?>index.php/RegistrarController/index" class="text-info">Registrate aquí</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>