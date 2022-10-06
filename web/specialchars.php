<?php 
	$description = nl2br($description);
	$description = str_replace("-(", "<s>", $description);
	$description = str_replace(")-", "</s>", $description);
	$description = str_replace("<script", "<LOL>script<LOL>", $description);
	$description = str_replace("alert", "aaaaaaaaaaaaaaaaaelrt(\"LOLOLOLOLOL\");", $description);
 ?>