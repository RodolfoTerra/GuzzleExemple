<!doctype html>
<html lang="pt-br">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Guzzle Estruturado - By Rodolfo Terra</title>		
	</head>
	

	<body>
			
		<?php 

			ini_set('display_errors',1);

			$url = 'http://www.guiatrabalhista.com.br/guia/salario_minimo.htm';

			require './vendor/autoload.php';

			$myObj = new GuzzleHttp\Client([
				'headers' => ['User-Agent' => 'MyReader']
			]);

			$feedPage = $myObj->request('GET', $url);

			if ($feedPage->getStatusCode() == 200) {

				if ($feedPage->hasHeader('Content-Length')) {

					$contentlength = $feedPage->getHeader('Content-Length')[0];

					echo "<p> $contentlength bytes lidos.</p>";
				}

				$body = $feedPage->getBody();

				$bodyString = (string) $body;

				$array1 = explode("<td width=\"150\" align=\"center\" style=\"margin: 0px;\" padding=\"0px;\">", $bodyString);
				$array2 = explode("</td>", $array1[0]);

				$request = [];
				$array = [];
				$limit = count($array2);
				$lines = round($limit/7);
				$i = 0;
				$a = 6;

				while ($i < $lines) {

					$array = [
						'vigencia'	   => $array2[$a++],
						'valor_mensal' => $array2[$a++],
						'valor_diario' => $array2[$a++],
						'valor_hora'   => $array2[$a++],
						'normal_legal' => $array2[$a++],
						'dou'		   => $array2[$a++]
					];					

					array_push($request, $array);

					$i++;
				}

				print_r($request);

			}
			
		?>

	</body>	
</html>
