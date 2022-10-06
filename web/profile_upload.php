<?php
include_once 'loginDB.php';


if ($is_logged == 'NO') {
	echo "<script>alert(\"회원서비스입니다 로그인해 주세요.\"); location.href='login.php';</script>";
}


if(isset($_POST['profile_url'])) {
	$sql = "UPDATE user SET profile='".$_POST['profile_url']."' WHERE nickname=\"".$user_id."\"";
	mysqli_query($conn, $sql);
	//$status = 'Y';
}
else{
   // $status = 'N';
	echo "URL 이 없습니다.";
	header('Location: index.php');
}


//$result = array('sql' => $sql, 'status' => $status, 'profile_url_rt' => $_POST['profile_url']);
//echo json_encode($result);
?>