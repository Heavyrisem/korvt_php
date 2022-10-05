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
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>마이페이지 - <?php echo $user_id; ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="gopage.js"></script>

	<script>
 		 UPLOADCARE_LOCALE = "ko";
 		 UPLOADCARE_TABS = "file url facebook gdrive gphotos dropbox instagram evernote flickr skydrive";
 		 UPLOADCARE_PUBLIC_KEY = "ebd2dfafc7d9060f169e";
 	</script>
	<script charset="utf-8" src="//ucarecdn.com/libs/widget/3.2.3/uploadcare.full.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript">
		function upload(info) {
			$.ajax({
  			type: "POST",
   			url: "./profile_upload.php",
   			dataType: 'json',
   			data: { "profile_url": info.cdnUrl },
   			complete: function(data) {
   					document.getElementById('profile_img').src = info.cdnUrl;
   			}
  		 	});
  		}
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
					<li id="1" onclick="go_link('pass_reset.php')" onmouseover="listbg_on(1)" onmouseout="listbg_off(1)">비밀번호 재설정</li>
					<li id="2" onclick="go_link('id_reset.php')" onmouseover="listbg_on(2)" onmouseout="listbg_off(2)">아이디 재설정</li>
					<li id="3" onclick="go_link('nick_reset.php')" onmouseover="listbg_on(3)" onmouseout="listbg_off(3)">닉네임 재설정</li>
					<li id="4" onclick="go_link('deleteuser.php')" onmouseover="listbg_on(4)" onmouseout="listbg_off(4)">회원탈퇴</li>
				</ul>
			</div>
		</div>
		<div id="page">
			<h2 style="font-size: 50px;">내정보</h2> <br>
			<div id="my_info">
				<?php 
					echo '<h2>프로필 사진</h2>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<div id="profile_div"><img id="profile_img" src="'.$row['profile'].'" /></div><br><input type="hidden" role="uploadcare-uploader" name="content" data-public-key="ebd2dfafc7d9060f169e" data-images-only />';
					echo '<h3>내아이디:&nbsp'.$row['name'].'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="id_reset.php">아이디 변경</a></h3><br>';
					echo '<h3>닉네임:&nbsp'.$row['nickname'].'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="nick_reset.php">닉네임 변경</a></h3><br>';
				 ?>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var singleWidget = uploadcare.SingleWidget('[role=uploadcare-uploader]');

		singleWidget.onUploadComplete(function(info)
		{
			var state = upload(info);
		});
	</script>
</body>
</html>