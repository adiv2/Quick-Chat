<?php
session_start(); 
$sid=$_SESSION['usr'];
$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$lastMes = file_get_contents('chatLog.txt');
$lastMes= preg_replace("</br>", "", $lastMes);
$arr = explode("\n",$lastMes);
for($i=0;$i<sizeof($arr)-1;$i++)
{
	if(( strpos( $arr[$i], $sid ) == false ))
	{
		$lastMes=$arr[$i];
	}
}
$lastMes= preg_replace("/[^a-zA-Z]/", "", $lastMes);
$lastMes= strtolower($lastMes);
$suggest=array();
	$filter = [];
    $options = ["projection" => ['_id' => 0]];

    $query = new MongoDB\Driver\Query($filter, $options);
    $rows = $mng->executeQuery("mark1.".$sid, $query);
    $emp=array();
    foreach ($rows as $row) {
          
           $array[] = json_decode(json_encode($row), True); }
    $lastMes1=$sid.$message;
		$lastMes1= preg_replace("</br>", "", $lastMes1);
		for($i=0;$i<sizeof($array);$i++)
		{
			if(implode(array_keys($array[$i]))== $lastMes)
			{
				$suggest[] = $array[$i][$lastMes];
			}
		}

echo $suggest[sizeof($suggest)-2];
?>
