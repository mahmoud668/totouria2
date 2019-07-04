<?php 

    include('config/db_connect.php');

    $user_id = 1;
    //echo $user_id;
    
   if(isset($_POST['submit'])){
        // Get form data

       
        
		$name = mysqli_real_escape_string($conn, $_POST['name']);
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        

		$query = "INSERT INTO cats(name, user_id) VALUES('$name', '$user_id')";

		if(mysqli_query($conn, $query)){
			header('Location:index.php');
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
    }
    
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Add a question</h4>
		<form class="white" action="addcat.php" method="POST">
			<label>Category Name</label>
			<input type="text" name="name"  >
			
			
			
			
			<div class="center">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">  
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>
	<?php include('templates/footer.php'); ?>

</html>