<?php

$CMD = $_POST["CMD"];

switch($CMD){
	case "ToShow":
		SetMessagesToShow();
		break;
	
	case "AddNew":
		AddNewMessage();
		break;
}

Function SetMessagesToShow()
{
	$count = $_POST["count"];
	$msg = "";
	
	$fileName = "messages.txt";
	$handle = fopen($fileName,'w') or die("can't open file");
	
	if($count != 0){
		for($i = 0; $i < $count; $i++){
		
			$checked = $_POST["chkMsg_".$i];
			$msg = $checked. "##" . $_POST["msg_".$i];
			
			fwrite($handle,$msg." \r\n");
		}
	}
	
	fclose($handle);
	
	ReturnToMessages();
}

Function AddNewMessage()
{

	$fileName = "messages.txt";
	$handle = fopen($fileName,'a') or die("can't open file");
	
	$newMsg = $_POST["newMsg"];
	
	fwrite($handle,"##".$newMsg." \r\n");
	
	fclose($handle);
	
	ReturnToMessages();
}

Function ReturnToMessages()
{
	echo "Sėkmingai išsaugota";
	?>
	<p><input type="button" value="Grįžti" onclick="window.location.href='index.php'"></p>
	<?
}
?>