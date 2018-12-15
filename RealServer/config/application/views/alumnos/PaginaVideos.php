<!DOCTYPE html>
<html>
	<head>
		<title>Página principal</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css">
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/main.js"></script>				
	</head>
	<body>
		<div class="container">					
			<?php foreach ($results as $result): ?>
				<video style="width: 500px; height: auto;" src="<?php echo base_url();?>/videos/<?php echo $result .'.mp4' ?>" controls></video>
			<?php endforeach; ?>
		</div>		
	</body>
</html>