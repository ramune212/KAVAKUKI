<?php

Function GetCalendarView($date)
{
	$today = date("j", $date);
	$numberOfDays = date("t", $date);
	
	$month = date("n", $date);
	$year = date("Y", $date);
	$m = mktime(0, 0, 0, $month, 1 , $year);
	$firstDayInWeek = date("w",$m);
	$firstDayInWeek = $firstDayInWeek == 0 ? 7 : $firstDayInWeek;
	
	$firstRow = true;
	$day = 1;
	while ($day <= $numberOfDays) {
		
		if ($firstRow) {
5			?><tr><?
			
			for ($i = 1; $i < $firstDayInWeek; $i++) {
				?>
				<td></td>
				<?
			}
			
			for ($i = $firstDayInWeek; $i <= 7; $i++) {
				if($day == $today)
					$style = "style='color:red; font-weight:bold'";
				else
					$style = "";
				?>
				<td <?=$style?>><?=$day++;?></td>
				<?
			} 
			
			$firstRow = false;
			?></tr><?
			
		} else {
			
			if ($day <= $numberOfDays) {
				?><tr><?
				
				for ($i = 1; $i <= 7; $i++) {
					if ($day <= $numberOfDays) {
						if($day == $today)
							$style = "style='color:red; font-weight:bold'";
						else
							$style="";
						?>
						<td <?=$style?>><?=$day++;?></td>
						<?
					}
					else {
					?>
					</td>
					<?
					}
				}
				
				?></tr><?
			}
		}
	}
}

Function GetMonthLtName($date)
{
	$month = date("n",$date);
	
	switch ($month){
		case 1:
			echo "Sausis";
			break;
		case 2:
			echo "Vasaris";
			break;
		case 3:
			echo "Kovas";
			break;
		case 4:
			echo "Balandis";
			break;
		case 5:
			echo "Gegužė";
			break;
		case 6:
			echo "Birželis";
			break;
		case 7:
			echo "Liepa";
			break;
		case 8:
			echo "Rugpjūtis";
			break;
		case 9:
			echo "Rugsėjis";
			break;
		case 10:
			echo "Spalis";
			break;
		case 11:
			echo "Lapkritis";
			break;
		case 12:
			echo "Gruodis";
			break;
	}	
}

?>