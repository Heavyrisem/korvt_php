<?php		
	include 'loginDB.php';
	
	$nickname = $_SESSION['user_id'];
	$id = $_GET['id'];
	
	// 22 featured
	$getRelatedTopicQuery = "SELECT * FROM topic where id=".$id;
	$relatedTopic = mysqli_fetch_assoc(mysqli_query($conn, $getRelatedTopicQuery));
	date_default_timezone_set('Asia/Seoul');
	
	if ($is_logged == 'YES' && $relatedTopic['author'] == $nickname && !($_POST['title'] == NULL) && !($_POST['description'] == NULL) && !($relatedTopic['author'] == NULL) && !($id == NULL) or $user_id == 'Admin' && !($id == NULL)) {
		$description = $_POST['description'];
		$now = date('Y-m-d H:i:s', time());
		
		include_once 'specialchars.php';
		
		$sql = "update topic set title='".$_POST['title']."', description='".$description."', author='".$nickname."', created='".$now."' where id='".$id."';";
		
		mysqli_query($conn, $sql);
		
		header('Location: index.php');
	}else{
		// echo($relatedTopic[]);
		// echo("is_logged: {$is_logged}, author: {$relatedTopic['author']}, nickname: {$nickname}, title: {$_POST['title']}, description: {$_POST['description']}, author: {$relatedTopic['author']}, id: {$id}");
		echo "<script>alert(\"잘못된 접근입니다.\"); location.href='index.php';</script>";
	}

	

	
 ?>