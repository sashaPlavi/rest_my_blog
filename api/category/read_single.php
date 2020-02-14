<?php

header('Access_Control_Allow_Origin: *');
header('Content-type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//instantiate db
$database = new Database();
$db = $database->connect();

$cat = new Category($db);
// geting id from url and seting in Category instance
$cat->id = isset($_GET['id']) ? $_GET['id'] : die();

$cat->read_single();

$cat_arr = array(
    'id' => $cat->id,
    'name' => $cat->name
);
print_r(json_encode($cat_arr));
