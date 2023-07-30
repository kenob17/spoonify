<?php 

require_once ('../MysqliDb.php');
$db = new MysqliDb ('localhost', 'root', '', 'spoonify');

// For AJAX

$id = $_POST['id'];

$db->where('id', $id);

$data = Array();

if( $db->delete('calendar')){
    $data['success'] = true;
    $data['message'] = "Deleted";
} else {
    $data['success'] = false;
    $data['message'] = "Error";
}

echo json_encode($data);




?>