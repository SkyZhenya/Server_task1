<?php

class Article
{

	public static function createArticles($title, $text)
	{
		$db = Database::getConnection();
		$sql = 'INSERT INTO article (
					title,
					text
						)
					VALUES (
					:title,
					:text
						)
						';
		$result = $db->prepare($sql);
		$result->bindParam(':title', $title, PDO::PARAM_STR);
		$result->bindParam(':text', $text, PDO::PARAM_STR);
		return $result->execute();

	}
	public static function getArticles()
	{
		$db = Database::getConnection();
		$sql = 'SELECT * FROM article';
		$result = $db->prepare($sql);
		$result->execute();
		return $result->fetchAll();
		
	}

	public static function getArticlesById($id)
	{
		$id = intval($id);
		$db = Database::getConnection();
		$sql = 'SELECT * FROM article WHERE id='.$id;
		$result = $db->prepare($sql);
		$result->execute();
		return $result->fetchAll();
	}

	public static function updateArticles($id, $title, $text)
	{
		$db = Database::getConnection();
		$sql = 'UPDATE article SET 
						title = "'.$title.
						'", text = "'.$text.
						'" WHERE
						id ='.$id;
		$result = $db->prepare($sql);
		return $result->execute();

	}

	public static function deleteArticles($id)
	{
		$db = Database::getConnection();
		$sql = 'DELETE FROM article WHERE id=:id';
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		return $result->execute();



	}

}