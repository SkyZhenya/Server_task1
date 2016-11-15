<?php

class ArticleController
{
	public static function create()
	{
		$title = htmlspecialchars($_REQUEST['title']);
		var_dump($text = htmlspecialchars($_REQUEST['text']));

		$result = Article::createArticles($title, $text);
		var_dump($result);
	}

	public static function update()
	{
		$id = htmlspecialchars($_REQUEST['id']);
		$title = htmlspecialchars($_REQUEST['title']);
		$text = htmlspecialchars($_REQUEST['text']);
		$result = Article::updateArticles($id, $title, $text);
		var_dump($result);
	}

	public static function delete()
	{
		$id = htmlspecialchars($_REQUEST['id']);
		$result = Article::deleteArticles($id);
		var_dump($result);

	}

	public static function get()
	{
		$result = Article::getArticles();
		var_dump($result);
	}

	public static function getById()
	{
		$id = htmlspecialchars($_REQUEST['id']);
		$exist = Article::checkIdExist($id);
		if (!empty($exist)){
			$result = Article::getArticlesById($id);
			var_dump($result);
		}
		else
		{
			http_response_code(404);
		}
	}
}
