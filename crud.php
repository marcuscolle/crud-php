<?php 

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crud');

if($mysqli->connect_error){
	echo "Error " . $mysqli->connect_error;
}

$id = 0;
$update = false;
$name = "";
$location = "";


//checking if save button has been pressed
if(isset($_POST['save'])){

	$stmt = $mysqli->prepare("INSERT INTO test (user, location) VALUES(?,?)");

	$stmt->bind_param("ss", $name, $location);
	
	$name = $_POST['name'];
	$location = $_POST['location'];

	$stmt->execute();

	$_SESSION['message'] = "Record has been saved!";
	$_SESSION['msg_type'] = "success";

	//redirected to index page
	header("location: index.php");

}


if(isset($_GET['delete'])){

	$id = $_GET['delete'];

	$mysqli->query("DELETE FROM test WHERE id=$id");

	$_SESSION['message'] = "Record has been deleted!";
	$_SESSION['msg_type'] = "danger";

	// redirected to index page
	header("location: index.php");
}



if(isset($_GET['edit'])){
	
	$id = $_GET['edit'];
	$update = true;
	$result = $mysqli->query("SELECT * FROM test WHERE id=$id");

	$row = $result->fetch_array();
	$name = $row['user'];
	$location = $row['location'];
}


if(isset($_POST['update'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$location = $_POST['location'];

	$mysqli->query("UPDATE test SET user='$name', location='$location' WHERE id=$id");

	$_SESSION['message'] = "Recorde has benn updated";
	$_SESSION['msg_type'] = "warning";

	header('location: index.php');
}
 ?>


