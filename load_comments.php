<?php 
include 'loginDB.php';

extract($_POST);

if (!($topic_id == NULL) && !($is_runed == NULL) && !($now_time == NULL)) {
	if ($is_runed == "NO") {
		$sql = "SELECT * FROM comment WHERE topic_id=\"".$topic_id."\"";
	}elseif ($is_runed == "YES"){
		$sql = "SELECT * FROM comment WHERE topic_id='".$topic_id."' AND created>date_add('".$now_time."',interval -5 second)";
	}
	$result = mysqli_query($conn, $sql);

	$looped = 0;
	$comments = array();
	while ($row = mysqli_fetch_assoc($result))
	{	
		$looped = $looped + 1;
		$sql_profile = "SELECT * FROM user WHERE nickname=\"".$row['writer']."\"";
		$reslut_profile = mysqli_query($conn, $sql_profile);
		$row_profile = mysqli_fetch_assoc($reslut_profile);


		$div ='
		<div id="comment">
			<div id="top_comment">


				<div id="user_info_comment">
					<img id="user_profile_comment" src="'.$row_profile['profile'].'">
					<div id="wroted_time">&nbsp&nbsp'.$row['created'].'</div>
					<div id="nickname_comment">'.$row['writer'].'</div>
				</div>



				<div id="option_comment">
					<a id="delete_comment" 	onclick="remove_comment(this)">삭제</a>
				</div>
			</div>



			<div id="bottom_comment">
				<div id="comment_msg">
					'.nl2br($row['msg']).'
				</div>	
			</div>
		</div>';


		${$looped} = array("comment"=>$div, "created"=>$row['created']);
		//$comments[${$looped}] = ${$looped};
		$comments[$looped] = ${$looped};
		//$comments = var_dump($comments[$looped]);
	}			
	$comments[0] = $looped;
		//$comments_msg = array("id"=>$comments_id, "msg"=>$comments_msg, "writer"=>$comments_writer, "day"=>$comments_day, "lop"=>$looped);
}else{
	$comments[0] = "error";
	$comments['id'] = $topic_id;
	$comments['is_runed'] = $is_runed;
	$comments['now_time'] = $now_time;
}
echo json_encode($comments);
 ?>