<?php 

require_once ('../MysqliDb.php');
$db = new MysqliDb ('localhost', 'root', '', 'spoonify');

// For AJAX

$user_id = $_POST['user_id'];
$food_id = $_POST['id'];
$note = $_POST['note'];
$source = $_POST['source'];
$date = $_POST['date'];



$db->where('user_id', $user_id);
$db->where('food_id', $food_id);
$db->where('date', $date);


$data = Array();

if(!( $db->getOne('calendar'))){
    $info = Array(
        "user_id" => $user_id,
        "food_id" => $food_id,
        "note" => $note,
        "sourceLink" => $source,
        "date" => $date
    );
   if( $db->insert('calendar', $info)){
        $data['success'] = true;
        $data['message'] = "Added";
   } else {
        $data['success'] = false;
        $data['message'] = "Error";
    }
    
} 
echo json_encode($data);




?>