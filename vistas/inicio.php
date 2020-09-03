<?php 
	session_start();
	//si está llena nos mostrará el html
	if (isset($_SESSION['usuario'])) {
?>

<!DOCTYPE html>
<html>
<head>
	<title>inicio</title>
	<?php require_once "menu.php"; ?>
</head>
<body>


</body>
</html>
	
<?php 
	}else {
		header("../index.php");
	}

?>