<?php 
	include('loginDB.php');


	if ($is_logged == 'NO') {
		echo "<script>alert(\"회원서비스입니다 로그인해 주세요.\"); location.href='login.php';</script>";
	}

	$sql = "SELECT * FROM user WHERE nickname='$user_id'";

	$result = mysqli_query($conn, $sql);

	$row = mysqli_fetch_assoc($result);

	if ($row == NULL) {
		echo "<script>alert(\"잘못된 접근입니다.\"); location.href='index.php';</script>";
	}

	if(!($_POST['change_pass'] == NULL) && !($_POST['change_pass_re'] == NULL))
	{
		if ($_POST['change_pass'] == $_POST['change_pass_re']) 
		{
			$password_hashed = password_hash($_POST['change_pass'], PASSWORD_BCRYPT);

			$sql = "UPDATE user SET password='$password_hashed' WHERE nickname='$user_id'";
			mysqli_query($conn, $sql);

			echo "<script>alert(\"비밀번호가 변경되었습니다.\"); location.href='login.php';</script>";
		}else
		{
			echo "<script>alert(\"비밀번호가 다릅니다.\"); location.href='logout.php';</script>";
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>비밀번호 재설정</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="gopage.js">
	</script>
</head>
<body>
	<div id="navbar">
		<div id="loginnav">
			<div id="menu">
				<ul id="lognavr">
					<li><?php echo $user_id ?>&nbsp;&nbsp;|</li>
					<li>
					<?php
					if ($is_logged == 'YES') {
						echo '<a href="logout.php">로그아웃</a>';
					}elseif($is_logged == 'NO' or $is_logged == NULL){
						echo '<a href="login.php">로그인</a>';
					}
					?>	
					</li>
					<li><?php if($is_logged == 'NO') {
					 echo '<a href="singup.php">회원가입</a>';
					}
					?>
					</li>
					<li><a href="write.php">글쓰기</a></li>
				</ul>
			</div>
		 	<div id="main"><a href="index.php"><img class="main_img" src="/imgs/korvt.png"></a></div>
		</div>
	</div>
	<div id="contents">
		<div id="pagenav">
			<div id="viewpage"><h4>마이페이지</h4></div>
			<div id="pagelist">
				<ul>
					<li id="1" onclick="go_link('pass_reset.php')'" class="selected">비밀번호 재설정</li>
					<li id="2" onclick="go_link('id_reset.php')" onmouseover="listbg_on(2)" onmouseout="listbg_off(2)">아이디 재설정</li>
					<li id="3" onclick="go_link('nick_reset.php')" onmouseover="listbg_on(3)" onmouseout="listbg_off(3)">닉네임 재설정</li>
					<li id="4" onclick="go_link('deleteuser.php')" onmouseover="listbg_on(4)" onmouseout="listbg_off(4)">회원탈퇴</li>
				</ul>
			</div>
		</div>
		<div id="page">
			<h2 style="font-size: 50px;">내정보</h2> <br>
			<div id="my_info" >
				<?php 
					if (!$_POST['check_pass'] == NULL) {

						if (password_verify($_POST['check_pass'], $row['password'])) {
							echo '<form action="pass_reset.php" method="POST" style="overflow: hidden;">';
							echo '<div id="password_field" style="height: 0px;">';
							echo '<input type="password" name="change_pass" id="member_id" placeholder="비밀번호" title="비밀번호 입력"><br>';
							echo '<input type="password" name="change_pass_re" id="member_id" placeholder="비밀번호 재입력" title="비밀번호 재입력"></div>';
							echo '<div id="login_btn" style="float: right;"><input type="submit" value="확인"></div></form>';
						}

						if (!password_verify($_POST['check_pass'], $row['password'])) {
							echo "<script>alert(\"비밀번호가 틀립니다.\"); location.href='pass_reset.php';</script>";
						}

					}else {
						echo '<form action="pass_reset.php" method="POST" style="overflow: hidden;">';
						echo "<div id=\"check_pass_field\">";
						echo '<input type="password" name="check_pass" id="member_id" placeholder="비밀번호" title="비밀번호 입력"><br></div>';
						echo '<div id="login_btn" style="float: left;"><input type="submit" value="확인"></div></form>';
					}
				 ?>
			</div>
		</div>
	</div>
</body>
</html>