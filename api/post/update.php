<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Headers: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Headers,Content-type,Authorization,X-Requested-With');

include_once "C:/Users/mirev/Documents/Programação/Curso PHP/php-api/config/Database.php";
include_once 'C:/Users/mirev/Documents/Programação/Curso PHP/php-api/models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

$post->id = isset($_GET['id']) ? $_GET['id'] : die();
$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

if($post->update()) {
    echo json_encode(
        array('message' => 'Post Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Updated')
    );
}