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


 /*


	$result = $mysqli->prepare("UPDATE test SET user = :USER, location = :LOCATION WHERE id = :ID");

	$result->bindParam(":USER", $name);
	$result->bindParam(":LOCATION", $location);
	$result->bindParam(":ID", $id);

	$result->execute();




 // connection com mysql neste caso workbench
$conn = new PDO("mysql:dbname=dbphp7; host=localhost", "root", "");

$stmt = $conn->prepare("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID"); 

$login = "ze";
$password = "1256";
$id = 4;

$stmt->bindParam(":LOGIN", $login);
$stmt->bindParam(":PASSWORD", $password);
$stmt->bindParam(":ID", $id);

$stmt->execute();

echo "data Alterada";


*/




 ?>


