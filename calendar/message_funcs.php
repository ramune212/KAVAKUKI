<?php
require_once('database.php');

Function GetMessage($nr)
{
	$fileName = "messages/messages.txt";
	$handle = fopen($fileName,'r') or die("can't open file");
	
	$msg_arr = file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	$size = count($msg_arr);
	
	$tmp = 0;
	$msg = "";
	
	if($size != 0){
		for($i = 0; $i < $size; $i++){
			$split = explode("##",$msg_arr[$i]);
			
			if ($split[0] == "on"){
				$tmp += 1;
				
				if($tmp == $nr){
					echo $split[1];
				}
			}
		}
	}
	
	fclose($handle);
}

Function GetTweet($nr)
{
	$db = Database::getInstance();
	$n = $nr - 1;
	
	$sSQL = " SELECT name, tweet, tdate FROM kavakuki_tweet ORDER BY id DESC LIMIT 2";
	$result[] = $db->getAll($sSQL);
	$size = count($result[0]);

	if($size != 0){
		$row = $result[0][$n];
		$message =  "<font color='black'><font color='red'>".$row["name"].":</font><font color='black'> ".$row["tweet"]."</font><br/><font size='1pt'>[".$row["tdate"]."]</font></font>";
		echo $message;
	}
}
?>