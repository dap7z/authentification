<?php




function br2nl($text)
{
	//inverse de la fonction php nl2br($text)
	/*
		$text = str_replace("<br />","",$text);
		$text = str_replace("<br>","",$text);
		return $text;
	*/
	$text = str_replace(array("\r", "\n"), '', $text);
	$text = str_replace(array('<br>', '<br />'), "\n", $text);
	return $text;
}
?>