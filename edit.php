<?php 
	include('loginDB.php');
	$result = mysqli_query($conn, $gettopic);

	$sql = "SELECT * FROM topic WHERE id=".$id;

	$result =  mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$rows = mysqli_num_rows($result);

	if ($is_logged == 'YES' && $user_id == $row['author'] && $rows == '1' or $user_id == 'Admin') {
		
	}else{
		echo "<script>alert(\"잘못된 접근입니다.\"); location.href='index.php';</script>";
	}
	$id = $_GET['id'];
	echo $row['author'];
 ?>
<!DOCTYPE html>
<html>
<head>

	<title>편집</title>

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

						if($_GET['id'] == $row['id'])
							{
								echo " class=\"selected\"";
							}



						echo '><p>'.$row['title'].'</p></li>';
					} ?>
				</ul>
			</div>
		</div>
		<div id="page">
			<form id="write_field" action="<?php echo "editprocess.php?id=".$id; ?>" method="POST">

				<?php 
					$getdata = "SELECT * FROM topic WHERE id='$id'";
					$result = mysqli_query($conn, $getdata);
					$row = mysqli_fetch_assoc($result);

					$description_edited = nl2br($row['description']);
					$description_edited = str_replace("<s>", "-(", $description_edited);
					$description_edited = str_replace("</s>", ")-", $description_edited);
				?>

				제목: <input type="text" name="title" value="<?php echo $row['title']; ?>"><br><br>
				내용: <br><textarea type="text" name="description" class="description_field"><?php echo $description_edited; ?></textarea><br><br>
				<input type="submit" name="submit" value="완료" class="write_send_btn">
			</form>
		</div>
	</div>
</body>
</html>