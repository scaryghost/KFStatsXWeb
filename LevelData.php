<?php
$stats= simplexml_load_file('http://127.0.0.1:8080/index.xml');
$result= $stats->xpath("stats[@category='levels']");

$jsonData["cols"]= array(array("label" => "Name", "type" => "string"), 
        array("label" => "Wins", "type" => "number"), array("label" => "Losses", "type" => "number"), 
        array("label" => "Time", "type" => "number"));

$jsonData["rows"]= array();
$index= 0;
foreach($result[0] as $level) {
    $row= array();

    $row["c"]= array();
    $row["c"][0]= array("v" => strval($level["name"]), "f" => null);
    $row["c"][1]= array("v" => intval($level["wins"]), "f" => null, "p" => array("style" => 'text-align: center;'));
    $row["c"][2]= array("v" => intval($level["losses"]), "f" => null, "p" => array("style" => 'text-align: center;'));
    $row["c"][3]= array("v" => intval($level["rawtime"]), "f" => strval($level["time"]), 
            "p" => array("style" => 'text-align: center;'));
    $jsonData["rows"][$index]= $row;
    $index++;
}
//print_r($jsonData);
echo  json_encode($jsonData);
?>
