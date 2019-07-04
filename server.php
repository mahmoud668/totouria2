<?php
session_start();

// initializing variables
$name = "";
$email    = "";
$level = "1";
$val = "0";
$val_code = rand();
$errors = array(); 

// connect to the database
include('config/db_connect.php');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($name)) { array_push($errors, "name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists


    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
      //echo 'x1';
  	$password = $password_1;//encrypt the password before saving in the database

  	$query = "INSERT INTO users (name, email, password, level, val, val_code) 
  			  VALUES('$name', '$email', '$password', '$level', '$val', '$val_code')";
  	//echo $query;
  	 //mysqli_query($conn, $query);
  	  mysqli_query($conn, $query);
  	 //echo $test;
      //echo 'x2';
  	// echo $result;
      //echo 'x3';

      $to      = $email;
      $subject = 'confirmation email';
      $message = 'please click this link to confirm your register  '.'http://dev.toprealapps.com/validation.php?val_code='.$val_code;
      $headers = 'From: info@toprealapps.com' . "\r\n" .
          'Reply-To: info@toprealapps.com' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();

      mail($to, $subject, $message, $headers);


     /* $to = $email;
      $subject = "My subject";
      $txt = "Hello world!";
      $headers = "From: webmaster@example.com" . "\r\n" .
          "CC: somebodyelse@example.com";

      mail($to,$subject,$txt,$headers);*/


      $_SESSION['name'] = $name;
      $_SESSION['email'] = $email;

      $_SESSION['success'] = "You are now logged in";

     /* $con = $_POST['con'];
      echo $con;*/

      header('location: login.php');



  }

    /*$to = $email;
    $subject = 'welcome';
    $message = 'welcome you';
    $from = 'peterparker@email.com';

    //Sending email
    if(mail($to, $subject, $message)){
        echo 'Your mail has been sent successfully.';
    } else{
        echo 'Unable to send email. Please try again.';
    }*/

}




// $to = 'mahmoud.sa.com';
// $subject = 'Marriage Proposal';
// $message = 'Hi Jane, will you marry me?'; 
// $from = 'peterparker@email.com';
 
// // Sending email
// if(mail($to, $subject, $message)){
//     echo 'Your mail has been sent successfully.';
// } else{
//     echo 'Unable to send email. Please try again.';
// }
// ... 


// LOGIN USER
if (isset($_POST['login_user'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);


    $password = mysqli_real_escape_string($conn, $_POST['password']);
  
    if (empty($name)) {
        array_push($errors, "name is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

   /* $sql444 = "SELECT * FROM users WHERE val_code = $val_code";
    $result2 = mysqli_query($conn, $sql444);
    $catnames = mysqli_fetch_all($result2, MYSQLI_ASSOC);

    foreach($catnames as $catname) {
        $nam = $catname['val'];

        if ($nam == '1'){
           echo "welcome";
        }else{
            echo "nooooo";
        }
        //echo $nam;

    }*/


    if (count($errors) == 0) {
        //$password = $password;
        $query = "SELECT * FROM users WHERE name='$name' AND password='$password'";
        $results = mysqli_query($conn, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['name'] = $name;
          $_SESSION['email'] = $email;

            $con = $_POST['con'];
            echo $con;

        $_SESSION['success'] = "You are now logged in";
          header('location: index.php');
        }
    }
  }
  
  ?>
