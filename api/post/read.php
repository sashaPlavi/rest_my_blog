<?php

header('Access_Control_Allow_Origin: *');
header('Content-type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//instantiate db
$database = new Database();
$db = $database->connect();

$post = new Post($db);


$res = $post->read();

$row = $res->rowCount();

if ($row > 0) {
    $post_arr = array();
    $post_arr['data'] = array();
    while ($n_row = $res->fetch(PDO::FETCH_ASSOC)) {
        extract($n_row);
        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name


        );
        array_push($post_arr['data'], $post_item);
    }

    echo json_encode($post_arr);
} else {
    echo json_encode(
        array('message' => 'no post found')
    );
}
