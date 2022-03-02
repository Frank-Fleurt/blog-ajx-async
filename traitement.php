<?php
require './Class/Form.php';
require './Class/Article.php';
$db = 'mysql:host=127.0.0.1;dbname=async_await';
$db_user = "root";
$db_pwd = "";

try {
  // Connection à la base de données
  $DBconnect = new PDO($db, $db_user, $db_pwd);
  $DBconnect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo json_encode([
    "status" => "error",
    "message" => $e->getMessage()
  ]);
}


if (!empty($_POST)) {

  $title = Form::secure($_POST['title']);
  $content = Form::secure($_POST['content']);
  $author = Form::secure($_POST['author']);

  $post = new Article($title, $content, $author);

  if ($post->validate() === true) {

    $req = $DBconnect->prepare('INSERT INTO post(title, content, author) 
    VALUES(:title, :content, :author)');

    $req->execute($post->toArray());

    echo json_encode([
      "status" => "ok",
      "message" => "Ajout bien "
    ]);
  }
} else {
  try {
    $req = 'SELECT title, content, author, createdAt FROM post';
    $data = $DBconnect->query($req)->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo json_encode([
      "status" => "error",
      "message" => $e->getMessage()
    ]);
  }
  echo '<pre>';
  var_dump($data);
  echo '</pre>';
}
