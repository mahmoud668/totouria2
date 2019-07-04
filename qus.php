<?php 

    include('config/db_connect.php');

	$cat_id = $_GET['cat_id'];
    
    
    if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
        $g_id = mysqli_real_escape_string($conn, $_POST['g_id']);

		$sql = "DELETE FROM qus WHERE id = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			header("Location: qus.php?id=$g_id");
		} else {
			echo 'query error: '. mysqli_error($conn);
		}

	}


	// write query for all pizzas
	if(isset($_GET['id'])){
		
		// escape sql chars
		$id = mysqli_real_escape_string($conn, $_GET['id']);


		$sql = "SELECT * FROM qus WHERE group_id = $id";

	// get the result set (set of rows)
	$result = mysqli_query($conn, $sql);

	// fetch the resulting rows as an array
	$pizza = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $sql444 = "SELECT * FROM groups WHERE id = $id";
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

    <div class="card-action center-align">
 		<a class="btn brand z-depth-0" href="addqus.php?group_id=<?php echo $id ?>">Add question</a>
							
	</div>

	<div class="container">
		<div class="row">

			<?php foreach($pizza as $pizz): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0">
						<img src="img/pizza.svg"class="pizza">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($pizz['q']); ?></h6>
                            <h6><?php echo htmlspecialchars($pizz['nt']); ?></h6>
                            <h6><?php echo htmlspecialchars($pizz['n1']); ?></h6>
                            <h6><?php echo htmlspecialchars($pizz['n2']); ?></h6>
                            <h6><?php echo htmlspecialchars($pizz['n3']); ?></h6>
							
						</div>
                       
                        <div class="card-action right-align">
 							<a class="brand-text" href="editqus.php?id=<?php echo $pizz['id'] ?>">Edit</a>
							
						</div>
						

                        <form action="qus.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $pizz['id']; ?>">
                            <input type="hidden" name="g_id" value="<?php echo $pizz['group_id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>
						
                        
					</div>
				</div>

			<?php endforeach; ?>

		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>