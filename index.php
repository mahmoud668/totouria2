<?php 

	include('config/db_connect.php');
	include('templates/header.php');

//echo $_SESSION['name'];
//echo $_SESSION['email'];

	$nn = $_SESSION['name'];  
	//echo $nn;

	$ee = $_SESSION['email'];  
	//echo $ee;

    $rr = "";





$sql33 = "SELECT * FROM users WHERE name = '$nn'";

// get the result set (set of rows)
$result = mysqli_query($conn, $sql33);

// fetch the resulting rows as an array
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

//print_r($users['name']);

// free the $result from memory (good practise)
mysqli_free_result($result);

foreach($users as $user){
    $rr = $user['val'];

}

if ($rr == 1){
    //echo $rr;



	if(isset($_POST['delete'])){

		echo $_POST['delete'];

		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);


        $sql = "DELETE FROM qus WHERE cat_id = $id_to_delete" ;
        $sql2 = "DELETE FROM groups WHERE cat_id = $id_to_delete" ;
        $sql3 = "DELETE FROM cats WHERE id = $id_to_delete ";

        if(mysqli_query($conn, $sql)){
			header('Location: index.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}

        if(mysqli_query($conn, $sql2)){
            header('Location: index.php');
        } else {
            echo 'query error: '. mysqli_error($conn);
        }


        if(mysqli_query($conn, $sql3)){
            header('Location: index.php');
        } else {
            echo 'query error: '. mysqli_error($conn);
        }


    }





	// write query for all pizzas
	$sql44 = 'SELECT * FROM cats';

	// get the result set (set of rows)
	$result = mysqli_query($conn, $sql44);

	// fetch the resulting rows as an array
	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// free the $result from memory (good practise)
	mysqli_free_result($result);


/*foreach($pizzas as $pizza){
    echo $pizza['name'];

}*/

	// close connection
	mysqli_close($conn);

	//echo $_GET['name'];

}

?>

<!DOCTYPE html>
<html>
	
	 

	


    </div>
    <div class="card-action right-center">
        <a class="brand-text" href="catsjaon.php">json</a>

    </div>





    <div class="container">
        <div class="row">

        <div class="card-action center-align">


            <?php  if (!$rr == 1 ) : ?>



                <h4 class="center grey-text">error please login again</h4>
                <a  href="login.php" class="btn brand z-depth-0">login</a>
            <?php endif ?>

        </div>

        <div class="card-action center-align">


            <?php  if ($rr == 1 ) : ?>



                <a class="btn brand z-depth-0" href="addcat.php">Categories</a>
            <?php endif ?>

        </div>


			<?php foreach($pizzas as $pizza): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0">
						<img src="img/pizza.svg"class="pizza">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($pizza['name']); ?></h6>
							
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="groups.php?id=<?php echo $pizza['id'] ?>">Click Here</a>
 							
						</div>
                        <div class="card-action right-align">
                            <a class="brand-text" href="groupsjson.php?id=<?php echo $pizza['id'] ?>&cat=<?php echo $pizza['name'] ?>">json format</a>

                        </div>



                        <div class="card-action right-align">
							<a class="brand-text" href="editcat.php?id=<?php echo $pizza['id'] ?>">Edit</a>
							
						</div>
						<form action="index.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>
						
					</div>
				</div>

			<?php endforeach; ?>
        </div>

		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>