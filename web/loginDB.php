<?php 
	// $conn = mysqli_connect("192.168.0.201", "rfgd_19085480", "PASSWORD_MASKED") or die("데이터베이스 연결 오류입니다!"); //DB 연결 실패시 알림 정보 conn에 저장
	$conn = mysqli_connect("korvt_db", "root", "password", "korvt", "3306") or die("데이터베이스 연결 오류입니다!"); //DB 연결 실패시 알림 정보 conn에 저장
	//$conn = mysqli_connect("127.0.0.1", "root", "PASSWORD_MASKED");
	// mysqli_select_db($conn, "korvt") or die("데이터베이스 선택 오류입니다!"); //DB 선택 rfgd_19085480_korvt 실패시 알림
	//mysqli_select_db($conn, "opentutorials");
	mysqli_query($conn, "set session character_set_connection=utf8;");
	mysqli_query($conn, "set session character_set_results=utf8;");
	mysqli_query($conn, "set session character_set_client=utf8;"); //DB 한글깨짐오류 수정용

	$gettopic = "SELECT * FROM topic"; //변수 지정 topic에서 가져오기

	@session_start(); //로그인용 세션 시작

	$is_logged = $_SESSION['is_logged']; //로그인 확인
	$user_id = '로그인 안됨'; //기본값 로그인 안됨 세팅
	if ($is_logged == 'YES') {
		$user_id = $_SESSION['user_id']; //로그인 YES일시 유저 아이디로 설정
	}
 ?>