<?php
    include('config/db_connect.php');
    
    $cat_id = $_GET['id'];
    echo $cat_id;
	// Check For Submit
	if(isset($_POST['submit'])){
		// Get form data
        $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
		$name = mysqli_real_escape_string($conn, $_POST['name']);



		$query = "UPDATE cats SET 
					name='$name'
					
						WHERE id = {$update_id}";

		if(mysqli_query($conn, $query)){
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
	}

	// get ID
	$id = mysqli_real_escape_string($conn, $_GET['id']);

	// Create Query
	$query = 'SELECT * FROM cats WHERE id = '.$id;

	// Get Result
	$result = mysqli_query($conn, $query);

	// Fetch Data
	$post = mysqli_fetch_assoc($result);
	//var_dump($posts);

	// Free Result
	mysqli_free_result($result);

	// Close Connection
	mysqli_close($conn);
?>

<?php include('templates/header.php'); ?>
<section class="container grey-text">
		<h5>Edit Question</h5>
		<form class="white" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
			<div class="form-group">
				<label>New Name</label>
				<input type="text" name="name" class="form-control" value="<?php echo $post['name']; ?>">

			</div>


            <input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
		</form>
	</div>
    </section>
    <?php include('templates/footer.php'); ?>