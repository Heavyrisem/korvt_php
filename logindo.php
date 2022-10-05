<meta charset="utf-8">
<?php
session_start();
extract($_POST);

if ($id == NULL) {
	$_SESSION['is_logged'] = 'NO';
	$_SESSION['user_id'] = '';
	echo "<script>alert(\"아이디를 입력해 주세요!\"); location.href='login.php';</script>";
}

if ($password == NULL) {
	$_SESSION['is_logged'] = 'NO';
	$_SESSION['user_id'] = '';
	echo "<script>alert(\"비밀번호를 입력해 주세요!\"); location.href='login.php';</script>";
}

include 'loginDB.php';

$loginsql = "SELECT * FROM user WHERE name='$id'";
$idresult = mysqli_query($conn,$loginsql);
if ($idresult->num_rows == 0) 
{	//아이디가 없을때
	$_SESSION['is_logged'] = 'NO';
	$_SESSION['user_id'] = '';
	echo "<script>alert(\"아이디가 맞지 않습니다.\"); location.href='login.php';</script>";
} elseif ($idresult->num_rows == 1) 
{	//아이디 찾음
	//비밀번호 얻어오기
	$row = mysqli_fetch_assoc($idresult);
	$hash = $row['password'];
	//비밀번호 비교
	if (!password_verify($password, $hash))
	 { //비밀먼호 다름
	$_SESSION['is_logged'] = 'NO';
	$_SESSION['user_id'] = '';
		echo "<script>alert(\"비밀번호가 맞지 않습니다.\"); location.href='login.php';</script>";
	} elseif (password_verify($password, $hash))
	 { //로그인 성공
	 	$getnickname = "SELECT * FROM user WHERE name='$id'";	 	
		$getip = "UPDATE user SET ip=\"".$_SERVER['REMOTE_ADDR']."\" WHERE nickname=\"".$row['nickname']."\"";
	 	mysqli_query($conn, $getip);
	 	mysqli_query($conn,$getnickname);
	 	$_SESSION['is_logged'] = 'YES';
	 	$_SESSION['user_id'] = $row['nickname'];
		echo "<script>location.href='index.php';</script>";
	}
}


 ?>