<?php

$handler="google.visualization.Query.setResponse";
$handler= $handler. "({version: '0.6', reqId: '0', status: 'ok', table:";
$query= split("," , $_GET['tq']);

$file= 'http://127.0.0.1:8080/records.xml?page='. $query[0] . '&rows=' . $query[1];
$stats= simplexml_load_file($file);

$jsonData["cols"]= array(array("label" => "Name", "type" => "string"), 
        array("label" => "Wins", "type" => "number"), array("label" => "Losses", "type" => "number"), 
        array("label" => "Disconnects", "type" => "number"));

$jsonData["rows"]= array();
$index= 0;
foreach($stats->records->record as $record) {
    $row= array();

    $name= strval($record["name"]);
    $steamid64= strval($record["steamid64"]);

    $row["c"]= array();
    $row["c"][0]= array("v" => $name, "f" => "<a href='profile.html?steamid64=" . $steamid64 . "'>" . $name .  "</a>");
    $row["c"][1]= array("v" => intval($record["wins"]), "f" => null, "p" => array("style" => 'text-align: center;'));
    $row["c"][2]= array("v" => intval($record["losses"]), "f" => null, "p" => array("style" => 'text-align: center;'));
    $row["c"][3]= array("v" => intval($record["disconnects"]), "f" => null, "p" => array("style" => 'text-align: center;'));
    $jsonData["rows"][$index]= $row;
    $index++;
}
$handler= $handler . json_encode($jsonData) . "});";
echo $handler;
?>
