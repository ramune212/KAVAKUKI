<?php

include 'simple_html_dom.php';

Function GetTemperature($mod1, $mod2)
{
	$html = file_get_html("http://www.orai.lt/lt/prognozes/siauliai");
	
	if($mod1 == 1){
	
		$tr_arr = $html->find('tr[class=oraiTableRow1]');
		$td_arr = $tr_arr[0]->find('td');
		$strr1 = explode("<br>", $td_arr[1]->innertext);
		$strr2 = $td_arr[3]->innertext;
		$temp = htmlentities($strr1[1]);
		
		if(stripos($temp,"-") === FALSE){
			$t = str_replace("&deg;C","",$temp);
			if($t != "0"){
				$temp = "+" . $temp;
			}
		}
		
		if($mod2 == 0){
			echo $temp;
		}
		elseif($mod2 == 1){
			$strr2 = iconv('windows-1257','UTF-8',$strr2);
			echo GetWeatherImageName($strr2);
		}
	}
	elseif($mod1 == 2){
		
		$tr_arr = $html->find('tr[class=oraiTableRow2]');
		$td_arr = $tr_arr[0]->find('td');
		$strr1 = explode("<br>", $td_arr[1]->innertext);
		$strr2 = $td_arr[3]->innertext;
		$temp = htmlentities($strr1[1]);
		
		if(stripos($temp,"-") === FALSE){
			$t = str_replace("&deg;C","",$temp);
			if($t != "0"){
				$temp = "+" . $temp;
			}
		}
	
		if($mod2 == 0){
			echo $temp;
		}
		elseif($mod2 == 1){
			$strr2 = iconv('windows-1257','UTF-8',$strr2);
			echo GetWeatherImageName($strr2);
		}
	}
}

Function GetWeatherImageName($weather)
{
	if (stripos($weather,"lietus") !== FALSE or stripos($weather,"palyti") !== FALSE or stripos($weather,"palis") !== FALSE){
		$imagename = "images\\rain2.png";
	}
	elseif(stripos($weather,"debesuota") !== FALSE or stripos($weather,"rūkas") !== FALSE){
		$imagename = "images\cloudy.png";
	}
	elseif(stripos($weather,"sniegas") !== FALSE or stripos($weather,"snigs") !== FALSE or stripos($weather,"pustys") !== FALSE 
			or stripos($weather,"pūga") !== FALSE or stripos($weather,"snigti") !== FALSE){
		$imagename = "images\snow.png";
	}
	elseif(stripos($weather,"šlapdriba") !== FALSE or stripos($weather,"lijundra") !== FALSE){
		$imagename = "images\icy.png";
	}
	elseif(stripos($weather,"saulė") !== FALSE or stripos($weather,"saulėta") !== FALSE){
		$imagename = "images\sunny2.png";
	}
	else{
		$imagename = "images\\rain2.png";
	}
	
	return $imagename;
}
?>