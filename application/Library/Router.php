<?php

namespace application\Library;
use application\Controller\ArticleController;

class Router
{
	private $routes;
	private $data;

	public function __construct()
	{
		$routesPath = ROOT.'/application/config/routes.php';
		$this->routes = include ($routesPath);
	}

	private function getURI()
	{
		if (isset($_SERVER['REDIRECT_BASE'])) {
			return str_replace($_SERVER['REDIRECT_BASE'], '', $_SERVER['REDIRECT_URL']);
		} else {
			return $_SERVER['REDIRECT_URL'];
		}
	}

	private function find($type)
	{
		$path = $this->getURI();
		$routes = $this->routes;
		foreach ($routes[$type] as $route => $value) {
			$url = array_filter(explode('/', $route));
			$pathDir = explode('/', $path);
			if(count($pathDir) == count($url)) {
				$res = array_map(function($el1, $el2) {
					if(strnatcasecmp($el1, $el2) === 0 || stristr($el1, '$')) {
						return true;
					} else {
						return false;
					}
				}, $url, $pathDir);
				if(!in_array(false, $res)) {
					return $value;
				}
			}
		}
		return FALSE;
	}

	public function getParams()
	{
		$uri = $this->getURI();
		$uri = explode("/", $uri);
		return $params = array_pop($uri);

	}

	public function run()
	{
	$params = $this->getParams();

	$method = $_SERVER['REQUEST_METHOD'];
	$value = $this->find($method);
	if ($value){
		$segments = explode('/', $value);
		$controllerName = ucfirst(array_shift($segments).'Controller');
		$actionName = (array_shift($segments));
		$controllerFile = 'application\\Controller\\'.$controllerName;
		$controllerObject = new $controllerFile;
		$result = $controllerObject->$actionName($params);
		}
	else {
			http_response_code(404);
		}
	}
}
