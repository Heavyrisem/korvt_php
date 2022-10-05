<?php 

 $str = "테스트";

 $encode = array('ASCII','UTF-8','EUC-KR');

 $str_encode = mb_detect_encoding($str, $encode);

 if(strtoupper($str_encode) == 'UTF-8') {

echo 'UTF-8 입니다';

 }
 ?>