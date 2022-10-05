<meta charset="utf-8">
<?php		
	include 'loginDB.php';

	$nickname = $_SESSION['user_id'];
	$id = $_GET['id'];

	if ($is_logged == 'YES' && $_POST['author'] == $nickname && !($_POST['title'] == NULL) && !($_POST['description'] == NULL) && !($_POST['author'] == NULL) && !($_POST['created'] == NULL) && !($id == NULL) or $user_id == 'Admin' && !($id == NULL)) {
		$description = $_POST['description'];
		$now = date('Y-m-d H:i:s', time());
		
		include_once 'specialchars.php';
		
		$sql = "update topic set title='".$_POST['title']."', description='".$description."', author='".$nickname."', created='".$now."' where id='".$id."';";

		mysqli_query($conn, $sql);

		header('Location: index.php');
	}else{
		echo "<script>alert(\"잘못된 접근입니다\"); location.href='index.php';</script>";
	}

	

	
 ?>