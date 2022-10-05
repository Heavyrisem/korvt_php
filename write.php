<?php 
	include('loginDB.php');
	$result = mysqli_query($conn, $gettopic);
	if ($is_logged == 'NO') {
		echo "<script>alert(\"회원서비스입니다 로그인해 주세요.\"); location.href='login.php';</script>";
	}
 ?>
<!DOCTYPE html>
<html>
<head>

	<title>글쓰기</title>

	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="gopage.js"></script>
</head>
<body>
	<div id="navbar">
		<div id="loginnav">
			<div id="menu">
				<ul id="lognavr">
					<li><?php echo $user_id ?>&nbsp;&nbsp;|</li>
					<li><?php if ($is_logged == 'NO') {
						echo '<a href="login.php"로그인</a>';
					} 
					echo '<a href="logout.php">로그아웃</a>';
					?></li>
					<li><?php if($is_logged == 'NO') {
					 echo '<a href="singup.php">회원가입</a>';
					}
					?>
					<li><a href="write.php">글쓰기</a></li>
				</ul>
			</div>
		 	<div id="main"><a href="index.php"><img class="main_img" src="/imgs/korvt.png"></a></div>
		</div>
	</div>
	<div id="contents">
		<div id="pagenav">
			<div id="viewpage"><h4>글쓰기</h4></div>
			<div id="pagelist">
				<ul>
					<?php
					$result = mysqli_query($conn, $gettopic);
					$row = mysqli_fetch_assoc($result);

					 while ($row = mysqli_fetch_assoc($result)) {
						echo '<li id='.$row['id'].' onclick="go_id('.$row['id'].')"';
						if (!($_GET['id'] == $row['id'])){
							echo ' onmouseover=\'listbg_on('.$row['id'].')\' onmouseout=\'listbg_off('.$row['id'].')\'';
						}
						echo '><p>'.$row['title'].'</p></li>';
					} ?>
				</ul>
			</div>
		</div>
		<div id="page">
			<form id="write_field" action="process.php" method="POST">
				제목: <input type="text" name="title"><br><br>
				내용: <br><textarea type="text" name="description" class="description_field"></textarea><br><br>
				<input type="submit" name="submit" value="완료" class="write_send_btn">
			</form>
		</div>
	</div>
</body>
</html>