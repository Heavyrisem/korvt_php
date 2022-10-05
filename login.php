<?php 
	include('loginDB.php');
 ?>
<!DOCTYPE html>
<html>
<head>

	<title>로그인 - Korvt</title>

	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="navbar">
		<div id="loginnav">
			<div id="menu">
				<ul id="lognavr">
					<li><a href="login.php">로그인</a></li>
					<li><a href="singup.php">회원가입</a></li>
				</ul>
			</div>
		 	<div id="main"><a href="index.php"><img class="main_img" src="/imgs/korvt.png"></a></div>
		</div>
	</div>
	<div id="contents">
		<div id="pagenav">
			<div id="viewpage"><h4>로그인</h4></div>
		</div>
		<div id="page">
			<h2>로그인</h2>
			<div id="pagecon">
				<form action="logindo.php" method="POST" class="loginform">
					<div id="login_field">
						<input type="text" name="id" id="member_id" placeholder="아이디" title="아이디 입력"> <br>
						<input type="password" name="password" id="member_pass" placeholder="비밀번호" title="비밀번호 입력">
					</div>
					<div id="login_btn">
						<input type="submit" value="로그인">
					</div>
				</form>
			<div>
		</div>
	</div>
</body>
</html>