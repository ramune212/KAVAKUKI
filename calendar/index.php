<?php
include 'calendar.php';
include 'weather.php';
include 'nameDay.php';

$givenDate = $_SERVER['QUERY_STRING'];
if ($givenDate != ""){
	$tmp = explode("-",$givenDate);
	if(count($tmp) == 3){
		$date = mktime(0,0,0,$tmp[1],$tmp[2],$tmp[0]);	
	}
}

if (($givenDate != "" and $date == "") or $givenDate == ""){
	$Y = date("Y");
	$m = date("n");
	$d = date("j");
	$date = mktime(0,0,0,$m,$d, $Y);
}

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
?>

<body bgcolor="black" scroll="no">
<style>
body {overflow: hidden}; 
</style>
<script type="text/javascript" src="nifty.js"></script>
<script type="text/javascript">
  window.onload = function() {
    if (!NiftyCheck()) {
      return;
    }
    Rounded("div#nifty", "#377CB1", "#9BD1FA", 30, 30);
  }

function change() {
	document.getElementById("clo").style.display="none";
	document.getElementById("tab").style.display="none";
	document.getElementById("logo").style.display="block";
	
	setTimeout("again()", 1);
}

function again() {
	document.getElementById("logo").style.display="none";	
	document.getElementById("tab").style.display="block";
//	document.getElementById("clo").style.display="block";
}

//setTimeout("change()", 1500);

function AutoRefresh(){
	alert("refresh");
	window.location.reload();
}

//setInterval("AutoRefresh()",3600000);

function RedirectToAnimacija(){
	var d = new Date();
	var m = d.getMinutes();
	if(m%10 == 0){
		window.location = "../animacija/";
	}
}

//setInterval("RedirectToAnimacija()",5000);

function RedirectToReklama(){
	var d = new Date();
	var m = d.getMinutes();
	switch(m){
		case 15: case 35: case 55:
			redirectUrl = "../reklama/pardavejosPaieska.html";
			break;
		case 5: case 25: case 45:
			redirectUrl = "../reklama/staloZaidimai.html";
			break;
		case 10: case 20: case 30: case 40: case 50:
			redirectUrl = "../reklama/nebukAntis.html";
			break;
		default:
			redirectUlr = "";
	}
	
	if (redirectUrl != ""){
		window.location = redirectUrl;
	}
	/*if(m == 15 || m == 35 || m == 55){
		window.location = "../reklama/kepameJums.html";
	}*/
}

setInterval("RedirectToReklama()",21000);

</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

<div id="logo" style="display:none;position:absolute;">
	<img src="logo.png">
</div>

<div style="position:absolute;left:238px;" id="clo">
	
	
	<!--
	<object type="application/x-shockwave-flash"
	 data="relog.swf"
	 width="200" height="200">
	<param name="movie" value="/flash/relog.swf">
	<param name="WMode" value="Transparent">
	</object>
	-->
	
<iframe frameborder="0" src="clock.html" scrolling="no" height="200">
</iframe>
<!--<embed src="http://www.adamdorman.com/flash/flip_clock_white_24_w-secs.swf" width="200" height="50" type="application/x-shockwave-flash"  wmode="opaque" quality="high"></embed>-->

<style>
a {color:white;}
td {text-align:center;color:white;}
* {font-family:tahoma;}
#nifty {
border-radius: 15px;
}
span {
	border-radius: 4px;
}
#date1, #date2 {
	border-radius: 6px;
}
#vard {
	border-radius: 10px;
}
</style>
</div>

<!--<div style="position:absolute;left:30px;top:260px;z-index:10;">-->
<div style="position:absolute;left:38px;top:220px;z-index:1;" id="tab">

<table width="500" cellpadding="10" cellspacing="0" bgcolor="white">
	<tr>
		<td bgcolor="black" width="100" align="center">
			<table>
				<tr>
					<td><span style="font-size:16px;">&nbsp;&nbsp;&nbsp;&nbsp;<?=GetMonthLtName($date);?>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
				</tr>
				<tr>
					<td>
						<div style="background:white;padding:1px;font-size:80px; border:1px solid white;color:black;width:88px;" id="nifty"><?= date("j",$date);?></div>
					</td>
				</tr>
			</table>
		</td>
		<td bgcolor="black">

			<table width="100%">
				<tr>
					<td><span style="border:1px solid white;color:black;background:white;padding:1px;">Pr</span></td>
					<td><span style="border:1px solid white;color:black;background:white;padding:1px;">A</span></td>
					<td><span style="border:1px solid white;color:black;background:white;padding:1px;">T</span></td>
					<td><span style="border:1px solid white;color:black;background:white;padding:1px;">K</span></td>
					<td><span style="border:1px solid white;color:black;background:white;padding:1px;">Pn</span></td>
					<td><span style="border:1px solid white;color:black;background:white;padding:1px;">Š</span></td>
					<td><span style="border:1px solid white;color:black;background:white;padding:1px;">S</span></td>
				</tr>
				<?= GetCalendarView($date);?>
			</table>
		</td>
		
		
		<td bgcolor="black" style="text-align:left;" nowrap>
			<table>
				<tr>
					<td style="text-align:left;">
						<span style="font-size:20px; border:1px solid white;color:black;background:white;padding:2px;" id="date1">Šiandien</span></td>
					<td nowrap><span style="font-size:40px;"><?php GetTemperature(1,0); ?></span></td>
					<td> &nbsp;&nbsp;<img src="<?php GetTemperature(1,1); ?>" <!--style="border:1px solid white;"--></td>
				</tr>
					<td style="text-align:left;"><span style="font-size:20px; border:1px solid white;color:black;background:white;padding:2px;" id="date2">Rytoj</span></td>
					<td nowrap><span style="font-size:40px;"><?php GetTemperature(2,0); ?></span></td>
					<td> &nbsp;&nbsp;<img src="<?php GetTemperature(2,1); ?>" <!--style="border:1px solid white;"--></td>
				</tr>
			</table>
		</td>
	</tr>
	

	<tr>
		<td colspan="3" bgcolor="black">
			<div style="background:white;padding:7px;text-align:left;" id="vard">
			<font color="black">
			<font color="red">Kavakukis: <font color="red">
			</font>
			<font color="black">
				<?=GetMessage(1)?>
			</font>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="3" bgcolor="black">
			<div style="background:white;padding:7px;text-align:left;" id="vard">
			<font color="black">
			<font color="red">Kavakukis: <font color="red">
			</font>
			<font color="black">
				<?=GetMessage(2)?>
			</font>
			</div>
		</td>
	</tr>	
	<!--
	<tr>
		<td colspan="3" bgcolor="black">
			<div style="background:white;padding:7px;text-align:left;" id="vard">
			<font color="black">
			<font color="red">Kavakukis (19:30): <font color="red">
			</font>
			<font color="black">
				už pusvalandžio visos bandelės vėl su 50% <br>nuolaida! geros medžioklės!
			</font>
			</div>
		</td>
	</tr>
	-->
	<tr>
		<td colspan="3" bgcolor="black">
			<span style="background:black;padding:7px;" id="vard">
			<font color="white">
			<?php GetNamesOfDay($date); ?>
			</font>
			</span>
		</td>
	</tr>	
</table>
<?
?>