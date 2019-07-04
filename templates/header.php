<?php

 session_start(); 

if (!isset($_SESSION['name'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['name']);
  header("location: login.php");
}

?>


<head>
	<title>Ninja Pizza</title>
	<!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <style type="text/css">
	  .brand{
	  	background: #cbb09c !important;
	  }
  	.brand-text{
  		color: #cbb09c !important;
  	}
  	form{
  		max-width: 460px;
  		margin: 20px auto;
  		padding: 20px;
  	}
    .pizza{
      width: 100px;
      margin: 40px auto -30px;
      display: block;
      position: relative;
      top: -30px;
    }
  </style>
</head>
<body class="grey lighten-4">
	<nav class="white z-depth-0">
    <div class="container">
      <a href="index.php" class="brand-logo brand-text">Mosabaqat Panel</a>

      <!-- <ul id="nav-mobile" class="right hide-on-small-and-down">
      <li><a href="login.php" class="btn brand z-depth-0">Users</a></li>
      </ul> -->

      <ul id="nav-mobile" class="right hide-on-small-and-down">
      <li><a  href="index.php?logout='1'" class="btn brand z-depth-0">logout</a></li>
      </ul>

      <ul id="nav-mobile" class="right hide-on-small-and-down">
      <?php  if (isset($_SESSION['name'])) : ?>
      <li><a style="color : #cbb09c" >Welcome <?php echo $_SESSION['name']; ?></a></li>

      <?php endif ?>
      </ul>
      
     
    </div>
    
  </nav>
