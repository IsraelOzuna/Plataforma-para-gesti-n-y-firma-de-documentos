<!DOCTYPE html>
<html>
	<head>
		<title>Editar perfil</title>
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
	</head>	
	<body>
		<div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
            <div class="wrapper wrapper--w680">
                <div class="card card-4">
                    <div class="card-body">
                        <form class="validate-form" id="forma" method="POST" action="<?php echo base_url()?>index.php/ControladorEditarPerfil/editarAcademico">
                            <span class="login100-form-title">
                                Editar perfil
                            </span>
                            <div class="wrap-input100 validate-input" data-validate = "Tú nombre es requerido">
                                <input class="input100" type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100 validate-input" data-validate = "Tú apellido es requerido">
                                <input class="input100" type="text" id="apellidos" name="apellidos"value="<?php echo $apellidos; ?>">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                            </div>                            
                            <div class="wrap-input100 validate-input" data-validate = "Teléfono requerido">
                                <input class="input100 input-number" type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>">
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
                                <input type="submit" class="login100-form-btn center" value="Guardar"></input>
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
</html>