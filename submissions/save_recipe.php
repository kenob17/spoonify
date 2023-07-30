<?php 

require_once ('../MysqliDb.php');
$db = new MysqliDb ('localhost', 'root', '', 'spoonify');


// For AJAX

$user_id = $_POST['user_id'];
$food_id = $_POST['id'];



$db->where('user_id', $user_id);
$db->where('food_id', $food_id);

$data = Array();

if(!( $db->getOne('saved_recipes'))){
    $info = Array(
        "user_id" => $user_id,
        "food_id" => $food_id
    );
    $db->insert('saved_recipes', $info);
    $data['success'] = true;
    $data['message'] = "Added";
} else {
    $db->where('food_id', $food_id);
    $db->delete('saved_recipes');
    $data['success'] = false;
    $data['message'] = "Removed";
}
echo json_encode($data);

?>