<?php

include('config/db_connect.php');

$group_id = $_GET['id'];

// write query for all pizzas
$sql = "SELECT * FROM qus WHERE group_id = '$group_id'";

// get the result set (set of rows)
$result = mysqli_query($conn, $sql);

$json_array = array();

while ($row = mysqli_fetch_assoc($result)){
    $json_array[] = $row;
}
echo json_encode($json_array);

/*echo '<pre>';
print_r($json_array);
echo '</pre>';*/



?>
