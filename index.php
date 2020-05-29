<!DOCTYPE hmtl>

<html> 
	<head>
		<title>PHP CRUD</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>

	<body>
		<?php require_once 'crud.php'; ?>

		<?php 

			if(isset($_SESSION['message'])):

		?>

		<div class="alert alert-<?=$_SESSION['msg_type'] ?>">

			<?php 

				echo $_SESSION['message'];
				unset($_SESSION['message']);

			?>

		</div>

			<?php endif ?>

		<div class="container">

		<?php

			$mysqli = new mysqli('localhost', 'root', '', 'crud');

			if($mysqli->connect_error){
			echo "Error " . $mysqli->connect_error;
			}

		
			$result = $mysqli->query("SELECT * FROM test") or die($mysqli->error);
		?>

		<div class="row justify-content-center">
			<table class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Location</th>
						<th colspan="2">Action</th>

					</tr>
				</thead>

			<?php

			while ($row = $result->fetch_assoc()): ?>
			
				<tr>
					<td><?php echo $row['user']; ?></td>
					<td><?php echo $row['location']; ?></td>
					<td>
					<a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>

					<a href="crud.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
					</td>
				</tr>

			<?php endwhile; ?>

			</table>
		</div>


	
	<div class="row justify-content-center">
		<form action="crud.php" method="POST">

			<input type="hidden" name="id" value="<?php echo $id; ?>">
			
			<div class="form-group">
				<lable>Name</lable>
				<input type="text" name="name" class="form-control" placeholder="Enter your name" value="<?php echo $name ?>">
			</div>

			<div class="form-group">
				<lable>Location</lable>
				<input type="text" name="location" class="form-control" placeholder="Enter your location" value="<?php echo $location ?>">
			</div>
			
			<div class="form-group">
				<?php 
				if($update== true):
				?>

					<button type="submit" class="btn btn-info" name="update">Update</button>

				<?php else: ?>
					<button type="submit" class="btn btn-primary" name="save">Save</button>

				<?php endif; ?>
			</div>

		</form>
	</div>
	</div>	
	
	</body>	



</html>