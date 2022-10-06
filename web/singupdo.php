<meta charset="utf-8">
<?php 
include 'loginDB.php';
extract($_POST);

if ($userid == NULL) {
	echo "<script>alert(\"아이디를 입력해주세요\"); location.href=\"singup.php\";</script>";
	exit();
}

if ($userpass == NULL) {
	echo "<script>alert(\"비밀번호를 입력해주세요\"); location.href=\"singup.php\";</script>";
	exit();
}

$idcheck = "SELECT * FROM user WHERE name='$userid'";
$nicknamecheck = "SELECT * FROM user WHERE nickname='$nickname'";
$idresult = mysqli_query($conn, $idcheck);

if ($idresult->num_rows == 1) {
	echo "<script>alert(\"이미 생성된 아이디입니다.\"); location.href=\"singup.php\";</script>";
	exit();
}

$nicknameresult = mysqli_query($conn, $nicknamecheck);

if ($nicknameresult->num_rows == 1) {
	echo "<script>alert(\"이미 등록된 닉네임 입니다.\"); location.href=\"singup.php\";</script>";
	exit();
}

if($userpass == $userpass_re)
{
	$userpass_P = password_hash($userpass, PASSWORD_BCRYPT);
	$insertodb = "INSERT INTO user(name,password,nickname) VALUES('$userid','$userpass_P','$nickname')";
	mysqli_query($conn,$insertodb);
	echo "<script>alert(\"회원가입 완료\"); location.href=\"index.php\";</script>";
} else{
	echo "<script>alert(\"비밀번호가 다릅니다\"); location.href=\"singup.php\";</script>";
}
echo "<script>alert(\"잘못된 접근입니다.\"); location.href=\"index.php\";</script>";
 ?>