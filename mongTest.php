<?php
$lastMes = file_get_contents('chatLog.txt');
$lastMes= preg_replace("</br>", "", $lastMes);
$arr = explode("\n",$lastMes);
print_r($arr);
for($i=0;$i<sizeof($arr)-1;$i++)
{
	if(( strpos( $arr[$i], 'Adi' ) == false ))
	{
		$lastMes=$arr[$i];
	}
}
$lastMes= preg_replace("/[^a-zA-Z]/", "", $lastMes);
echo $lastMes;

?>

