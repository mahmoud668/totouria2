<?php
	include('config/db_connect.php');
	// Check For Submit
	if(isset($_POST['submit'])){
		// Get form data
		$update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
        $group_id = mysqli_real_escape_string($conn, $_POST['update_idd']);
		$q = mysqli_real_escape_string($conn, $_POST['q']);
		$nt = mysqli_real_escape_string($conn, $_POST['nt']);
        $n1 = mysqli_real_escape_string($conn,$_POST['n1']);
        $n2 = mysqli_real_escape_string($conn,$_POST['n2']);
        $n3 = mysqli_real_escape_string($conn,$_POST['n3']);


		$query = "UPDATE qus SET 
					q='$q',
					nt='$nt',
					n1='$n1',
                    n2='$n2',
                    n3='$n3' 
						WHERE id = {$update_id}";

		if(mysqli_query($conn, $query)){
			header("Location: qus.php?id=$group_id");

		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
	}

	// get ID
	$id = mysqli_real_escape_string($conn, $_GET['id']);

	// Create Query
	$query = 'SELECT * FROM qus WHERE id = '.$id;

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
				<label>Question</label>
				<input type="text" name="q" class="form-control" value="<?php echo $post['q']; ?>">
			</div>
			<div class="form-group">
				<label>Ttue Answer</label>
				<input type="text" name="nt" class="form-control" value="<?php echo $post['nt']; ?>">
			</div>
			<div class="form-group">
				<label>False 1</label>
				<textarea name="n1" class="form-control"><?php echo $post['n1']; ?></textarea>
			</div>
            <div class="form-group">
				<label>False 2</label>
				<textarea name="n2" class="form-control"><?php echo $post['n2']; ?></textarea>
			</div>
            <div class="form-group">
				<label>False 3</label>
				<textarea name="n3" class="form-control"><?php echo $post['n3']; ?></textarea>
			</div>

			<input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
            <input type="hidden" name="update_idd" value="<?php echo $post['group_id']; ?>">
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
		</form>
	</div>
    </section>
    <?php include('templates/footer.php'); ?>