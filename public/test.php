<?php

class Article
{
	public $id;
	public $title;
	public $content;
}

$pdo = new \PDO('mysql:dbname=spiral;host=127.0.0.1', 'root', 'kwait');
$or = new \spiral\framework\persistence\PDOObjectRepository($pdo);

$article = new Article();
$article->id = null;
$article->title = 'Hello world !';
$article->content = 'Content here';

$oid = $or->add($article);

var_dump($oid);