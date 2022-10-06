<?php 
session_start();

$_SESSION['is_logged'] = 'NO';
$_SESSION['user_id'] = '';
header("Location: index.php");
 ?>