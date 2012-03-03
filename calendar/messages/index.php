<?php

include 'login.php';

$fileName = "messages.txt";
$handle = fopen($fileName,'r') or die("can't open file");

$msg_arr = file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$size = count($msg_arr);

fclose($handle);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	
	<script type="text/javascript" language="javascript">
	function ShowMsg()
	{
		var inps = document.getElementsByTagName("input");
		var i, count;
		count = 0;
		
		for(i =0; i< inps.length; i++){
			if(inps[i].type == "checkbox"){
				if(inps[i].checked){
					count++;
				}
			}
		}
		
		if(count > 2){
			alert("Pažymėti galima tik dvi žinutes");
			return false;
		}
		
		var form = document.getElementsByTagName("form")[0];
		document.getElementById("CMD").value = "ToShow";
		form.submit();
	}

	function DeleteMsg()
	{
	
	}
	
	function AddNewMessage()
	{
		var form = document.getElementsByTagName("form")[0];
		document.getElementById("CMD").value = "AddNew";
		form.submit();
	}
	</script>
	
	<body>
		<p style="font-weight:bold;">Išsaugotos žinutės:</p>
		<p style="color:green; font-size:11">
			Pasirinkite žinutes, kurias norite rodyti kalendoriuje.
			Turi būti pažymėta ne daugiau nei 2 žinutės.
		</p>
		<table>
			<form action="save_msg.php" method="post">
				<input type="hidden" name="CMD" id="CMD" value=""/>
				<input type="hidden" name="count" id="count" value="<?=$size;?>"/>
			<?
				if ($size != 0){
					for($i = 0; $i < $size; $i++){
						$split = explode("##",$msg_arr[$i]);
						if($split[0] == "on"){
							$checked = "checked='checked'";
						}
						else{
							$checked = "";
						}
						?>
							<tr>
								<td><input name="chkMsg_<?=$i;?>" <?=$checked;?> type="checkbox" title="Rodyti kalendoriuje"/></td>
								<td><input name ="msg_<?=$i;?>" type="text" value="<?=$split[1];?>" style="border:none;" size="200px"/></td>
							</tr>
						<?
					}
				}
			?>
				<tr>
					<td colspan="2">
						<input type="button" value="Rodyti" onclick="ShowMsg()">&nbsp;&nbsp;&nbsp;&nbsp;
						<!--<input type="button" value="Trinti"></td>-->
				</tr>
				<tr height="100px" valign="bottom"><td colspan="2" style="font-weight:bold">Įrašyti naują žinutę:</td></tr>
				<tr>
					<td colspan="2">
						<textarea name="newMsg" cols="10" rows="4" style="width:400px"></textarea>
					</td>
				</tr>
				<tr><td colspan="2"><input type="button" onclick="AddNewMessage()" value="Saugoti"></td></tr>
			</form>
		</table>
	</body>
</html>