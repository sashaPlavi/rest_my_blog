<?php

header('Access_Control_Allow_Origin: *');
header('Content-type: application/json');
header('Access_Control_Allow_Methods: POST');
header('Access_Control_Allow_Heders: Access_Control_Allow_Heders,Content-type,Access_Control_Allow_Methods, Authorization,X-Requested-Width');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//instantiate db
$database = new Database();
$db = $database->connect();

$post = new Post($db);

//get row data
$data = json_decode(file_get_contents("php://input"));
$post->id = $data->id;


if ($post->delete()) {
    echo json_encode(
        array('message' => 'Post deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Post not deleted')
    );
}
