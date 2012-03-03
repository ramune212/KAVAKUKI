<?php

Function GetNamesOfDay($date)
{
	$day = date("z",$date);
	
	$fileName = "name_days.txt";
	$handle = fopen($fileName,'r') or die("can't open file");

	$trimmed = file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

	$nameDayStr = substr($trimmed[$day], 1, -1);
	
	echo $nameDayStr;
	
	fclose($handle);
}
?>