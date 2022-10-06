<?php 
include 'loginDB.php';

extract($_POST);

if ($writer && $msg && $now_page && $Y && $M && $D && $H && $Min && $S != NULL) {

	$Date = $Y.'-'.$M.'-'.$D.' '.$H.':'.$Min.':'.$S;

	$sql = "INSERT INTO comment(topic_id,msg,writer,created) VALUES('$now_page','$msg','$writer','$Date')";
	mysqli_query($conn, $sql);
	$state = 'YES';
	$return = array('state'=>'YES', 'writer'=>$writer, 'msg'=>$msg, 'now_page'=>$now_page);
	echo json_encode($return);
	
}else{
	$return = array('state'=>'NO');
	echo json_encode($return['state']);
}

 ?>