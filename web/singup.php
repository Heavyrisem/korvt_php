<?php 
	include('loginDB.php');
 ?>
<!DOCTYPE html>
<html>
<head>

	<title>회원가입 - Korvt</title>

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
			<div id="viewpage"><h4>회원가입</h4></div>
		</div>
		<div id="page">
			<h2 class="h2">회원가입</h2>
				<div id="pagecon_su">
				<!-- sing up -->
				<form action="singupdo.php" method="POST">
					<table class="table_class" style="margin-top: 0px;">
						<div id="singup_field">
							<caption></caption>
							<colgroup><col width="120px" class="none"><col width></colgroup>
							<tbody class="input_tb">
								<tr><th>아이디</th><td><input type="text" name="userid"></td></tr>
								<tr><th>비밀번호</th><td><input type="password" name="userpass"></td></tr>
								<tr><th>비밀번호 재입력</th><td><input type="password" name="userpass_re"></td></tr>
 								<tr><th>닉네임</th><td><input type="text" name="nickname"></td></tr>
 							</tbody>					
 						</div>
					</table>
				 <div id="singup_submit_btn">
 					<input type="submit" name="submit_btn" value="가입">
 				</div>
 			</form>
			</div>
		</div>
	</div>
</body>
</html>