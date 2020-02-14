<?php

header('Access_Control_Allow_Origin: *');
header('Content-type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//instantiate db
$database = new Database();
$db = $database->connect();

$category = new Category($db);


$res = $category->read();

$row = $res->rowCount();

if ($row > 0) {
    $cat_arr = array();
    $cat_arr['data'] = array();
    while ($n_row = $res->fetch(PDO::FETCH_ASSOC)) {
        extract($n_row);
        $cat_item = array(
            'id' => $id,
            'name' => $name,


        );
        array_push($cat_arr['data'], $cat_item);
    }

    echo json_encode($cat_arr);
} else {
    echo json_encode(
        array('message' => 'No category found')
    );
}
