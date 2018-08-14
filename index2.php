<!doctype html>
<html lang="pt-br">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Guzzle POO - By Rodolfo Terra</title>		
	</head>
	

	<body>
			
		<?php 

			ini_set('display_errors',1);

			require_once 'vendor/autoload.php';

			use App\Control\Salario as Salario;

			$salario = new Salario();
			
		?>

	</body>	
</html>
