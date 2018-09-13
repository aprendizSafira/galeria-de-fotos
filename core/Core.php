<?php
/*
-- Essa arquivo não faz parte da estrutura MVC. Ele apenas inicia esse processo.
*/
class Core {

	public function run() {//run = rodar
		//Vai pegar a aquela url que esta no get
		$url = '/';//Depois do / (meusite.com.br/)
		if(isset($_GET['url'])) {
			$url.= $_GET['url'];//se foi enviado uma url concatena
		}

		$params = array();
		//VERIFICANDO Se a pessoa enviou algun endereço do seu site
		if(!empty($url) && $url != '/') {
			//Caso ele tenha enviado um endereço especifico do site
			$url = explode('/', $url);
			//Tirando o array da posição 0, pois não serve para nada
			array_shift($url);//Remove o primeiro registro do array
			
			$currentControler = $url[0].'Controller';//fica (homeController)
			array_shift($url);//remove novamente

			//VERIFICANDO se o user enviou o action pela url
			if(isset($url[0]) &&  !empty($url[0])){//porque pode ser não ser enviado o action ou pior uma '/'
				$currentAction = $url[0];
				array_shift($url);
			} else {

				$currentAction = 'index';
			}

			
			if(count($url) > 0) {
				$params = $url;
			}

		} else {//OU SEJA: se a pessoa não enviou nada apenas o meusite.com.br/
			//Manda para o index.php
			$currentControler = 'homeController';
			$currentAction = 'index';
		}
		

		//INSTÂNCIANDO A CLASSE CONTROLLER
		$c = new $currentControler();//Pode ser contatoController-sobreController.

		//INSTÂNCIANDO a ACTION:
		//Vai pegar na classe a action que é a função que esta dentro da classe.Se não tiver parametro envia um array vazio
		call_user_func_array(array($c, $currentAction), $params);//Quando não sabe o name da função

	}
}