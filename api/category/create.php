<?php

header('Access_Control_Allow_Origin: *');
header('Content-type: application/json');
header('Access_Control_Allow_Methods: POST');
header('Access_Control_Allow_Heders: Access_Control_Allow_Heders,Content-type,Access_Control_Allow_Methods, Authorization,X-Requested-Width');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//instantiate db
$database = new Database();
$db = $database->connect();

$cat = new Category($db);

//get row data
$data = json_decode(file_get_contents("php://input"));


$cat->name = $data->name;


if ($cat->create()) {
    echo json_encode(
        array('message' => 'Category created')
    );
} else {
    echo json_encode(
        array('message' => 'Cateory  not created')
    );
}
