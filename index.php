<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

require 'Database.php';
require 'ArticleController.php';
require 'Article.php';

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
		case 'DELETE':
			ArticleController::delete();
			break;
		case 'POST':
			ArticleController::create();
			break;
		case 'GET':
			
			if (!empty($_REQUEST['id']))
			{
				$json = ArticleController::getById();
				if (!empty($json))
				{
					echo( json_encode($json));
				}
			}else
			{
				$json = ArticleController::get();
				echo( json_encode($json));
			
			}
			break;
		case 'PUT':
			ArticleController::update();
			break;
		default:
			http_response_code(404);
			break;
		}

function deliver_responce($status, $status_message, $data)
{
	header("HTTP/1.1 $status $status_message");
	$response['status'] = $status;
	$response['status_message'] = $status_message;
	$response['data'] = $data;

	$json_response = json_encode($response);
	echo $json_response;
}