<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" href="<?php echo base_url();?>images/icons/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/css-hamburgers/hamburgers.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/select2/select2.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/EstilosRegistrar/util.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/EstilosRegistrar/main.css">
        <link href="<?php echo base_url();?>vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="<?php echo base_url();?>css/EstilosRegistrar/main2.css" rel="stylesheet" media="all">        

        <title>Registro</title>
    </head>
    <body>
        <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
            <div class="wrapper wrapper--w680">
                <div class="card card-4">
                    <div class="card-body">
                        <form id="formularioRegistrar" method="post" class="validate-form">
                            <span class="login100-form-title">
                                Registro
                            </span>
                            <div class="wrap-input100 validate-input" data-validate = "Tú nombre es requerido">
                                <input class="input100" type="text" id="nombre" name="nombre" placeholder="Nombre(s)">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate = "Tú apellido es requerido">
                                <input class="input100" type="text" id="apellidos" name="apellidos" placeholder="Apellidos">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate = "El correo es requerido: ex@abc.xyz">
                                <input class="input100" type="email" id="correo" name="correo" placeholder="Correo Electrónico">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate = "Teléfono requerido">
                                <input class="input100 input-number" type="text" id="telefono" name="telefono" placeholder="Telefono">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate = "La constraseña es requerida">
                                <input class="input100" type="password" id="contrasena" name="contrasena" placeholder="Contraseña">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                </span>
                            </div>
                        
                            <div class="container-login100-form-btn">
                                <input type="submit" class="login100-form-btn center" value="Registrar"></input>
                            </div>
                        </form>
                        <form method="post">
                            <div class="modal fade modalRegistro" id="modalRegistro" role="dialog" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ingresa la clave</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="text">Ingresa la clave:</label>
                                                <input required max="4" type="num" class="form-control" id="claveConfirmacion" name="claveConfirmacion">
                                            </div>
                                            <div class="form-group">
                                                <input class="btn btn-block btn-primary" type="submit" id="btnConfirmar" name="confirmar" value="Confirmar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
        <script src="<?php echo base_url();?>vendor/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url();?>vendor/bootstrap/js/popper.js"></script>
        <script src="<?php echo base_url();?>vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>vendor/select2/select2.min.js"></script>
        <script src="<?php echo base_url();?>vendor/tilt/tilt.jquery.min.js"></script>
        <script src="<?php echo base_url();?>js/mainRegistrar.js"></script>
</html>