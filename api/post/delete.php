<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Headers: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Headers,Content-type,Authorization,X-Requested-With');

include_once "C:/Users/mirev/Documents/Programação/Curso PHP/php-api/config/Database.php";
include_once 'C:/Users/mirev/Documents/Programação/Curso PHP/php-api/models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

$post->id = isset($data->id) ? $data->id : die();

if($post->delete()) {
    echo json_encode(
        array('message' => 'Post Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Deleted')
    );
}