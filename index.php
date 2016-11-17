<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));

require __DIR__ . '/vendor/autoload.php';
use application\Library\Router;

$router = new Router();
$router->run();

//
//$method = $_SERVER['REQUEST_METHOD'];
//
//
//switch($method) {
//	case 'DELETE':
//		ArticleController::delete();
//		break;
//	case 'POST':
//		ArticleController::create();
//		break;
//	case 'GET':
//
//		if (!empty($params))
//		{
//			$json = ArticleController::getById($params);
//			if (!empty($json))
//			{
//				echo( json_encode($json));
//			}
//		}else
//		{
//			$json = ArticleController::get();
//			echo( json_encode($json));
//
//		}
//		break;
//	case 'PUT':
//		ArticleController::update();
//		break;
//	default:
//		http_response_code(404);
//		break;
//	}
