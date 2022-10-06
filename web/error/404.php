<!DOCTYPE html>
<html>
<head>
	<title>ERROR!-404</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="err_style.css">
	<script type="text/javascript">
		function logout() {
			location.href="/logout.php";
		}
	</script>
</head>
<body>
	<div class="error_messages">
		<div class="err_code">404</div><br>
		<div class="message"><h4>Not Found :(</h4></div><br><br>
		<div class="message_inf">해당 URL 에 해당하는 문서가 없습니다. URL 주소를 확인하고 다시 접속해주세요</div>
		<br><div class="logout"><input type="button" value="강제 로그아웃" onclick="logout()"></input></div>
	</div>
</body>
</html>