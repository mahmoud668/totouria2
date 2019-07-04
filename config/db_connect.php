<?php 

	// connect to the database
	$conn = mysqli_connect('localhost', 'topreala_mos', 'ELw?)!yoKz]k', 'topreala_masabaqat');

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}

?>