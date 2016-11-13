<?php
session_start(); 
$sid=$_SESSION['usr'];
$message = $_REQUEST["message"];
$chatLog = file_get_contents('chatLog.txt');
$chatLog = $chatLog.$sid.":".$message."\n"."</br>";
file_put_contents('chatLog.txt', $chatLog);
$chatString=$message;
$chatString= preg_replace("/[^a-zA-Z]/", "", $chatString);
$chatString= strtolower($chatString);
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
	$bulk = new MongoDB\Driver\BulkWrite;
    $doc = ['_id' => new MongoDB\BSON\ObjectID, $lastMes=> $message];
    $bulk->insert($doc);
    $mng->executeBulkWrite("mark1.".$sid, $bulk);
?>
