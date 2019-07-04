<?php

include('config/db_connect.php');

$nn = $_GET['val_code'];
//echo $nn;

// write query for all pizzas
$sql = "SELECT * FROM users";

// get the result set (set of rows)
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free the $result from memory (good practise)
mysqli_free_result($result);

// if(is_null($result['name'])){
// 	echo 'no data';
// }else{
// 	echo 'yes';
// }

foreach($users as $user){
    $rr = $user['val_code'];
    if($rr == $nn){
        //echo $user['name'];
        $email = $user['email'];
        //echo $email;

        $query = "UPDATE users SET 
					val='1'
					
						WHERE val_code = {$rr}";

        if(mysqli_query($conn, $query)){
            $yes_s = "";
            $yes_s = "welcome please login now";
            //echo "yesss";
        } else {
            echo 'ERROR: '. mysqli_error($conn);
        }

        //echo "yes";
        //header('location: login.php');
        break;
    }
}



// close connection
mysqli_close($conn);

//echo $_GET['name'];


?>

<!DOCTYPE html>
<html>
<?php include('templates/header2.php'); ?>



<section class="container grey-text">
    <h4 class="center grey-text"><?php echo $yes_s; ?></h4>


    <div align="center" class="input-group">
        <?php  if ($yes_s == "" ) : ?>
            <h4 class="center grey-text"><?php echo "error in confirm"; ?></h4>
        <?php endif ?>
    </div>

    <div align="center" class="input-group">
        <?php  if (!$yes_s == "" ) : ?>
            <a  href="login.php" class="btn brand z-depth-0">login</a>
        <?php endif ?>
    </div>

</section>
<?php include('templates/footer.php'); ?>

</html>