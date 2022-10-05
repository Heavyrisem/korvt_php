<meta charset="utf-8">
<?php 
include 'loginDB.php';

$id = $_GET['id'];

$sql = "SELECT * FROM topic WHERE id=".$id;

$result =  mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$rows = mysqli_num_rows($result);

if ($is_logged == 'YES' && $user_id == $row['author'] && $rows == '1' or $user_id == 'Admin') {

	;$delsql = "DELETE FROM topic WHERE id=".$id;

	mysqli_query($conn, $delsql);

	header("Location: index.php");
}else{
	echo "<script>alert(\"잘못된 접근입니다.\"); location.href='index.php';</script>";
}

 ?>