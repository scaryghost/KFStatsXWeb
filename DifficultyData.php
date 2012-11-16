<?php
$stats= simplexml_load_file('http://127.0.0.1:8080/index.xml');
$result= $stats->xpath("stats[@category='difficulties']");

$jsonData= array();
$jsonData["cols"]= array(array("label" => "Name", "type" => "string"), array("label" => "Length", "type" => "string"),
        array("label" => "Wins", "type" => "number"), array("label" => "Losses", "type" => "number"), 
        array("label" => "Avg Wave", "type" => "number"), array("label" => "Time", "type" => "number"));

$jsonData["rows"]= array();
$index= 0;
foreach($result[0] as $difficulty) {
    $row= array();

    $wins= intval($difficulty["wins"]);
    $losses= intval($difficulty["losses"]);

    $row["c"]= array();
    $row["c"][0]= array("v" => strval($difficulty["name"]), "f" => null);
    $row["c"][1]= array("v" => strval($difficulty["length"]), "f" => null);
    $row["c"][2]= array("v" => $wins, "f" => null, "p" => array("style" => 'text-align: center;'));
    $row["c"][3]= array("v" => $losses, "f" => null, "p" => array("style" => 'text-align: center;'));
    $row["c"][4]= array("v" => floatval($difficulty["wave"]), "p" => array("style" => 'text-align: center;'));
    $row["c"][5]= array("v" => intval($difficulty["rawtime"]), "f" => strval($difficulty["time"]), 
            "p" => array("style" => 'text-align: center;'));
    $jsonData["rows"][$index]= $row;
    $index++;
}

echo  json_encode($jsonData);
?>
