<?php 
	include('loginDB.php'); //데이터베이스 로그인 & 로그인 세션 생성, 연결

	$result = mysqli_query($conn, $gettopic); //loginDB에서 선행된 내용으로 DB 에서 topic 내용 모두 가져오기
	$usql = "SELECT * FROM user WHERE nickname=\"".$user_id."\""; //사용자의 닉네임을 user 에서 찾는 SQL 문장을 usql에 저장
	$sqlresult = mysqli_query($conn, $usql); //사용자의 닉네임을 찾고 가져오기
	$userrow = mysqli_fetch_assoc($sqlresult); //userrow에 sqlresult값 리턴
	if ($user_id == "AAAAAAAA") {
		echo "<script>location.href='/New/Untitled.mp4';</script>"; //테스트용
	}
 ?>
<!DOCTYPE html> <!-- HTML 시작 -->
<html>
<head>
	<title>Korvt</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css"> <!-- CSS로드 -->
	<script type="text/javascript" src="gopage.js"></script> <!-- 문서간 이동 스크립트 로드 -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script> <!-- 사용자 프로필 사진 로드용 소스 (UPloadCare) -->
	<script type="text/javascript" src="clock.js"></script> <!-- 메인홈 시계 로드 -->
	<script type="text/javascript"> //자바스크립트 구간
		var user_nickname = "<? echo $user_id; ?>"; //php에서 사용자의 닉네임 받아오기                                             클라이언트 실행중에는 php의 변경사항 반영 불가
		var is_logged = "<? echo $is_logged; ?>"; //로그인 되어있는지 php에서 받아오기 											 로그인 후에는 페이지 리로드로 php의 변경사항 받기
		var topic = "<? echo $_GET['id']; ?>"; //현재 문서 번호 얻어오기
		var comments = 0; //???
		var li = 1; //코멘트 순번 매기기

		function add_comment(comment_div, comment_date) { //최근 코멘트 알림
			var old = new Date(comment_date); //인자로 받은 코멘트의 시간 저장
			var now = new Date(); 				//현재 시간 저장
			var gap = now.getTime()-old.getTime(); //두 시간차 구하기
			var div = document.createElement('div'); //새 엘리먼트 만들기
			var com_id = "comment" + li;			//코멘트에 번호 주기
			div.setAttribute("id", com_id);			//준 번호로 코멘트의 아이디 변경
			div.innerHTML = comment_div;			//코멘트의 내용을 인자로 변경
			document.getElementById('page').appendChild(div);	//생성한 div를 page의 자식으로 붙이기
			if (gap < 30000) { //차이가 작다면
				document.getElementById(eval("'"+com_id+"'")).className = "few_second_comment"; //최근 알람을 표시하게 두기
				var del = 'Y';
				var A = 30000 - gap; //알람 삭제까지 남은시간 구하기
				setTimeout(function() {del_color(com_id);}, A); //남은 시간후에 del_color 호출로 알람 삭제	
			}
			/*if (del == 'Y') { //del이 Y일때

			}*/
			li++;
		}
		function del_color(c) { //최근 코멘트 표시 지우기
			document.getElementById(eval("'"+c+"'")).className = 'none'; //클래스 이름 변경
		}

		function remove_comment(obj) { //코멘트 삭제 (수정중)
			document.getElementById('page').removeChild(obj.parentNode.parentNode.parentNode.parentNode);
		}

		function comment_upload() { //코멘트 데이터베이스 업로드
			var msg = document.getElementById('comment_input').value;
			var date = new Date();
			$.ajax({
				type: "POST", //POST 형식으로 보내기, GET으로 보낼시 보안 위험, 받는 문서에서 extract($_POST); 으로 변수 모두 사용가능
				url: "./upload_comment.php", //코멘트 업로드 php
				dataType: 'json', //json형식으로 보내기
				data: { "writer": user_nickname , "msg": msg , "now_page": topic , "Y": date.getFullYear() , "M": (date.getMonth() + 1) , "D": date.getDate() , "H": date.getHours() , "Min": date.getMinutes() , "S": date.getSeconds() }, //데이터 내용 : 작성자, 메세지 내용, 코멘트 타겟 문서, 연도, 달, 일, 시, 분, 초 /시간 부분은 getDate로 가져오기
				success: function(data){ //성공시
					document.getElementById('comment_input').value = ''; //
				},
   				error: function(request,status,error) {
        			alert("error! " + " code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
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
					}else{
						echo '<a href="mypage.php">마이페이지</a>';
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
			<div id="viewpage"><h4>메인화면</h4></div>
			<div id="pagelist">
				<ul>
					<?php while ($row = mysqli_fetch_assoc($result)) {
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
			<?php
				if (empty($_GET['id']) == false) //현재 보는 문서가 있을시
				{
					$commentsql = "SELECT * FROM comment WHERE topic_id=\"".$_GET['id']."\"";
					$sql = 'SELECT * FROM topic WHERE id='.$_GET['id'];

					$commentresult = mysqli_query($conn, $commentsql);
					$result = mysqli_query($conn, $sql);	
					$row = mysqli_fetch_assoc($result);
					$comrow = mysqli_fetch_assoc($commentresult);



					$fp = fopen("comment_input.txt", "r"); //코멘트 작성 컨텐츠 HTML 불러오기
					$comment_input = fread($fp, filesize("comment_input.txt"));
					fclose($fp); //파일 관리자 종료
//--------------------------------------------------------------------------------------page내 최상단 시작---------------------------------------------------------------------------------------
					if ($user_id == $row['author'] or $user_id == 'Admin') { //작성자나 어드민일시 버튼 표시
						echo '<div id="delete"><a href="edit.php?id='.$row['id'].'">수정</a>&nbsp&nbsp&nbsp<a href="delete.php?id='.$row['id'].'">삭제</a></div>';
					}

					echo '<h2 style="font-size: 50px">'.$row['title'].'</h2>'; //제목 h2사이즈 표시
					echo '<br><br>'; 											//줄바꿈
					echo '<p sytle="font-size: 20px">'.$row['description'].'</p>'; //내용 표시 줄바꿈
					echo '<br><br><br>';										//줄바꿈
					echo '<hr><br>';											//라인 긋기
					echo '생성자:&nbsp'.$row['author'].'&nbsp&nbsp';				//작성자 표시
					echo '생성날짜:&nbsp'.$row['created'];						//생성 날짜 표시
					echo '<br><br><hr><br><br>';								//줄긋고 줄바꿈
					echo '<input type="button" value="TEST" onclick="poll('.$_GET['id'].')"></input><br>'; //코멘트 폴링 테스트 부분 /후에 삭제
					if ($is_logged == 'YES') { //코멘트 작성부분
						$comment_input = str_replace("nickname_here", $user_id, $comment_input); //코멘트 작성 프리셋에서 부분 수정
						$comment_input = str_replace("profile_here", $userrow['profile'], $comment_input); //str_replace("찾을문자열","치환할문자열","대상문자열")
						echo $comment_input;													//페이지에 쓰기
					}
				}else{ //아니면 시계 출력
					echo '<div class="clock_style" id="clock"></div> <script type="text/javascript"> printClock(); </script>'; //div 생성으로 시계가 들어갈 테두리 생성후 printClock호출
				}
			 ?>
			 <script type="text/javascript"> //댓글 읽어오기 폴링 간격 5000
			 	if (topic != "") { //현재 보는 문서가 있다면
			 		poll(topic);
			 		setInterval('poll(topic)', 5000);
			 	}
			 </script>
		</div>
	</div>
</body>
</html>