<?php
include 'simple_html_dom.php';

$url = "http://day.lt/diena/";
$year = date("Y");

$fileName = "name_days.txt";
$handle = fopen($fileName,'w') or die("can't open file");

for($m = 1; $m <= 12; $m++){

	$mk_date = mktime(0,0,0,$m,1,$year);
	$numberOfDays = date("t",$mk_date);
	
	for($d = 1; $d <= $numberOfDays; $d++){
		$mk_date = mktime(0,0,0,$m,$d,$year);
		$date = date("Y.m.d",$mk_date);
		$yearDayNumber = date("z",$mk_date);
		
		echo date("z",$mk_date) ." ";
		
		$full_url = $url . $date;
		
		echo $full_url . " ";
		
		$html = file_get_html($full_url);
		
		$p = $html->find('p[class=vardadieniai]');
		$names_string = "";
		foreach($p[0]->find('a') as $a){
			if($a->innertext != "pasveikink"){
				$names_string = $names_string . ", " . $a->innertext;
			}
		}
		
		echo $names_string . "<br/>";
		
		fwrite($handle,$names_string." \r\n");
	}
}
fclose($handle);
?>