<?php 

    include('config/db_connect.php');

    //echo $_GET['cat'];
   
    // if (isset($_GET['name'])) {
    //    // echo $_GET['name'];
    //    $name =  $_GET['cat'];
    //    echo $name;
    // } else {
    //     echo 'no name';
	// }

$id = $_GET['id'];
//echo $id."fddfdfdf";


    //print_r($_POST) ;
	if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
		$idd  = mysqli_real_escape_string($conn, $_POST['idd']);
		//$sql = "DELETE FROM qus, groups WHERE qus.group_id = $id_to_delete AND groups.id = $id_to_delete" ;
        $sql = "DELETE FROM qus WHERE group_id = $id_to_delete" ;
        $sql2 = "DELETE FROM groups WHERE id = $id_to_delete" ;


        if(mysqli_query($conn, $sql)){
			header("Location: groups.php?id=$idd");
		} else {
			echo 'query error: '. mysqli_error($conn);
		}

        if(mysqli_query($conn, $sql2)){
            header("Location: groups.php?id=$idd");
        } else {
            echo 'query error: '. mysqli_error($conn);
        }





    }



	// write query for all pizzas
	if(isset($_GET['id'])){


		
		// escape sql chars
		$id = mysqli_real_escape_string($conn, $_GET['id']);
		//echo $id;

		$sql = "SELECT * FROM groups WHERE cat_id = $id";

	// get the result set (set of rows)
	$result = mysqli_query($conn, $sql);



	// fetch the resulting rows as an array
	$pizza = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$sql444 = "SELECT * FROM cats WHERE id = $id";
        $result2 = mysqli_query($conn, $sql444);
        $catnames = mysqli_fetch_all($result2, MYSQLI_ASSOC);

foreach($catnames as $catname) {
    $nam = $catname['name'];
    //echo $nam;

}


	// free the $result from memory (good practise)
	mysqli_free_result($result);

	// close connection
	mysqli_close($conn);
	}


?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text"><?php echo $nam; ?></h4>

	<div class="container">

	<div class="card-action center-align">
	<a class="btn brand z-depth-0" href="addgroup.php?cat_id=<?php echo $id ?>">Add Group</a>
							
	</div>
		<div class="row">

			<?php foreach($pizza as $pizz): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0">
						<img src="img/pizza.svg"class="pizza">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($pizz['name']); ?></h6>
							
						</div>
                        <div class="card-action right-align">
							<a class="brand-text" href="qus.php?id=<?php echo $pizz['id'] ?>">Click Here</a>

						</div>

                        <div class="card-action right-align">
                            <a class="brand-text" href="qusjson.php?id=<?php echo $pizz['id'] ?>">json</a>
                        </div>

                        <div class="card-action right-align">
						<a class="brand-text" href="editgroup.php?id=<?php echo $pizz['id'] ?>">Edit</a>
							
						</div>
						<form action="groups.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $pizz['id']; ?>">
                            <input type="hidden" name="idd" value="<?php echo $id; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>
						
					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>