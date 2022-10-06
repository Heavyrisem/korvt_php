<?php 	
	include 'loginDB.php';

	$nickname = $_SESSION['user_id'];
	$description = $_POST['description'];

	if ($is_logged == 'YES' && !($_POST['title'] == NULL) && !($description == NULL) or $user_id == 'Admin') {

		include_once 'specialchars.php';

		$sql = "INSERT INTO topic(title,description,author,created) VALUES('".$_POST['title']."','".$description."','".$nickname."',now())";
		
		$result = mysqli_query($conn, $sql);
		echo $result;
	}else{
		echo "<script>alert(\"잘못된 접근입니다\");</script>";
	}

	header('Location: index.php');
 ?>