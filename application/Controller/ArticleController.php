<?php

namespace application\Controller;
use application\Models\Article;
/**
* @SWG\Swagger(
*	@SWG\Info(
*		title="API for Article direct",
*		version="1.0.0"
*	)
*)
*/

class ArticleController
{
	/**
	 * @SWG\Post(
	 *		path="/article",
	 *		summary="Add article",
	 *		description="Add article to database",
	 *		operationId="create",
	 *		@SWG\Parameter(
	 *			name="title",
	 *			description="Article title",
	 *			required="false",
	 *			type="string"
	 *		),
	 *		@SWG\Parameter(
	 *			name="text",
	 *			description="Article text",
	 *			required="false",
	 *			type="string"
	 *		)
	 * )
	 * @param Request $request
	 */

	public static function create()
	{
		$title = htmlspecialchars($_REQUEST['title']);
		var_dump($text = htmlspecialchars($_REQUEST['text']));

		$result = Article::createArticles($title, $text);
		var_dump($result);
	}

	/**
	 * 	 * @SWG\Put(
	 *		path="/article/{id}",
	 *		summary="Update article by ID",
	 *		description="Update article by ID from database",
	 *		operationId="update",
	 *		@SWG\Parameter(
	 *			name="id",
	 *			description="Article ID",
	 *			required="true",
	 *			type="string"
	 *		),
	 * 	 *	@SWG\Parameter(
	 *			name="title",
	 *			description="Title of article",
	 *			required="false",
	 *			type="string"
	 *		),
	 * 	 *	@SWG\Parameter(
	 *			name="text",
	 *			description="Text of article",
	 *			required="false",
	 *			type="string"
	 *		),
	 *		@SWG\Response(
	 *			response=200,
	 *			description="Success update article"
	 *		),
	 *		@SWG\Response(
	 *			response=404,
	 *			description="Not found article"
	 *		)
	 * )
	 * @param Request $request
	 */

	public static function update()
	{
		$id = htmlspecialchars($_REQUEST['id']);
		$title = htmlspecialchars($_REQUEST['title']);
		$text = htmlspecialchars($_REQUEST['text']);
		$exist = Article::checkIdExist($id);
		if (!empty($exist))
		{
			$result = Article::updateArticles($id, $title, $text);
			if (!empty($result))
			{
				echo "Success update article";
			}
			
		}
		else
		{
			http_response_code(404);
		}
	}

	/**
	 * @SWG\Delete(
	 *		path="/article/{id}",
	 *		summary="Remove article by ID",
	 *		description="Remove article by ID from database",
	 *		operationId="delete",
	 *		@SWG\Parameter(
	 *			name="id",
	 *			description="article ID",
	 *			required="true",
	 *			type="string"
	 *		),
	 *		@SWG\Response(
	 *			response=200,
	 *			description="Success remove article"
	 *		),
	 *		@SWG\Response(
	 *			response=404,
	 *			description="Not found article"
	 *		)
	 * )
	 * @param Request $request
	 */

	public static function delete($id)
	{
		$exist = Article::checkIdExist($id);
		if (!empty($exist))
			{
			$result = Article::deleteArticles($id);
			echo "Success remove article";
			}
		else
			{
				http_response_code(404);
			}
	}

	/**
	 * @SWG\Get(
	 *		path="/article",
	 *		summary="Get articles",
	 *		description="Get articles from database",
	 *		operationId="get",
	 *		@SWG\Response(
	 *			response=200,
	 *			description="Success get articles"
	 *		)
	 * )
	 * @param Request $request
	 */

	public static function get()
	{
		$result = Article::getArticles();
		//header('Content-Type: application/json');
		echo json_encode($result);
		
	}

	/**
	 * @SWG\Get(
	 *		path="/article/{id}",
	 *		summary="Get articles by ID",
	 *		description="Get articles by ID from database",
	 *		operationId="getById",
	 *		@SWG\Parameter(
	 *			name="id",
	 *			description="Article ID",
	 *			required="true",
	 *			type="string"
	 *		),
	 *		@SWG\Response(
	 *			response=200,
	 *			description="Success get post"
	 *		),
	 *		@SWG\Response(
	 *			response=404,
	 *			description="Not found post"
	 *		)
	 * )
	 * @param Request $request
	 */

	public static function getbyid($id)
	{
		$exist = Article::checkIdExist($id);
		if (!empty($exist)){
			$result = Article::getArticlesById($id);
			//header('Content-Type: application/json');
			echo json_encode($result);
		}
		else
		{
			http_response_code(404);
		}
	}

}
