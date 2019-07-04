<?php 

    include('config/db_connect.php');

	$group_id =  $_GET['group_id'];
	$cat_id =  '0';
	//echo $group_id;
	//echo $cat_id;
    $user_id = '1';

   if(isset($_POST['submit'])){
        // Get form data

       
        
		$q = mysqli_real_escape_string($conn, $_POST['q']);
		$nt = mysqli_real_escape_string($conn, $_POST['nt']);
        $n1 = mysqli_real_escape_string($conn,$_POST['n1']);
        $n2 = mysqli_real_escape_string($conn,$_POST['n2']);
        $n3 = mysqli_real_escape_string($conn,$_POST['n3']);
		$group_id = mysqli_real_escape_string($conn, $_POST['group_id']);

		$user_id = mysqli_real_escape_string($conn, $user_id);

        

		$query = "INSERT INTO qus(q, nt, n1, n2, n3, group_id, user_id) VALUES('$q', '$nt', '$n1', '$n2', '$n3', '$group_id', ($user_id))";

		if(mysqli_query($conn, $query)){
			header("Location:qus.php?id=$group_id");
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
		<form class="white" action="addqus.php" method="POST">
			<label>question</label>
			<input type="text" name="q"  >
			
			<label>true answer</label>
			<input type="text" name="nt"  >
			
			<label>false 1</label>
			<input type="text" name="n1"  >

            <label>false 2</label>
			<input type="text" name="n2"  >
			
            <label>false 3</label>
			<input type="text" name="n3" >
			
			
			<div class="center">
                <input type="hidden" name="group_id" value="<?php echo $group_id; ?>"> 

				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>
	<?php include('templates/footer.php'); ?>

</html>