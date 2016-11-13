<?php
//$chatString=$_REQUEST["message"];
try
{
	$filter = [];
	$suggest=array();
    $options = ["projection" => ['_id' => 0]];
    $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query($filter, $options);
    $rows = $mng->executeQuery("mark1.Aditya", $query);
    $emp=array();
    foreach ($rows as $row) {
          
           $array[] = json_decode(json_encode($row), True); }
           print_r($array);
		for($i=0;$i<sizeof($array);$i++)
		{
			if(implode(array_keys($array[$i]))== "TejasHello")
			{
				$suggest[] = $array[$i]["TejasHello"];
			}
		}
    print_r($suggest);
        
} catch (MongoDB\Driver\Exception\Exception $e) {

    $filename = basename(__FILE__);
    
    echo "The $filename script has experienced an error.\n"; 
    echo "It failed with the following exception:\n";
    
    echo "Exception:", $e->getMessage(), "\n";
    echo "In file:", $e->getFile(), "\n";
    echo "On line:", $e->getLine(), "\n";    
}
?>
