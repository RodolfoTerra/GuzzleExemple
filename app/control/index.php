<?php 

	namespace App\Control;

	/**
	 *  Class: Salario
	 */

	use GuzzleHttp\Client as Client;

	class Salario
	{

		private $url;
		private $myObj;

		
		function __construct()
		{
			$this->url = 'http://www.guiatrabalhista.com.br/guia/salario_minimo.htm';

			$this->myObj = new Client([
				'headers' => ['User-Agent' => 'MyReader']
			]);

			$this::pushPage();

		}


		private function pushPage()
		{

			$feedPage = $this->myObj->request('GET', $this->url);

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
		}
	}

