<?php

return [
	'GET' => [
		'/article/$id' => 'article/getbyid',
		'/article/' => 'article/get',
		'/' => 'article/get'
	],
	'POST' => [
		'/article/' => 'article/create'
	],
	'PUT' => [
		'/article/$id' => 'article/update'
	],
	'DELETE' => [
		'/article/$id' => 'article/delete'
	]

];