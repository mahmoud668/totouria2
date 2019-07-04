<?php include('server.php');

$con = $_POST['con'];
echo $con;

/*$sql22 = "SELECT * FROM users WHERE email = $email";

// get the result set (set of rows)
$result22 = mysqli_query($conn, $sql22);

// fetch the resulting rows as an array
$users = mysqli_fetch_all($result22, MYSQLI_ASSOC);

// free the $result from memory (good practise)
mysqli_free_result($result22);

// if(is_null($result['name'])){
// 	echo 'no data';
// }else{
// 	echo 'yes';
// }

foreach($users as $user){
    $rr = $user['val'];
    if($rr == '1'){
        //echo $user['name'];
        echo 'yesssssssss';
        //echo $email;

        //echo "yes";
        //header('location: login.php');
        break;
    }else{
        echo 'noooooo';
    }
}*/




?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="name" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>