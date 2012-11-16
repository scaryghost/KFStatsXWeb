<?php
$response="google.visualization.Query.setResponse({version: '0.6', reqId: '0', status: 'ok', table:";
$file= 'http://127.0.0.1:8080/sessions.xml?steamid64=' . $_REQUEST["steamid64"];
$stats= simplexml_load_file($file);

$jsonData["cols"]= array(array("label" => "Level", "type" => "string"), 
        array("label" => "Difficulty", "type" => "string"), array("label" => "Length", "type" => "string"), 
        array("label" => "Result", "type" => "string"), array("label" => "Wave", "type" => "number"), 
        array("label" => "Timestamp", "type" => "string"));

$jsonData["rows"]= array();
$index= 0;
foreach($stats->stats->entry as $entry) {
    $row= array();

    $row["c"]= array();
    $row["c"][0]= array("v" => strval($entry["level"]), "f" => null);
    $row["c"][1]= array("v" => strval($entry["difficulty"]), "f" => null, "p" => array("style" => 'text-align: center;'));
    $row["c"][2]= array("v" => strval($entry["length"]), "f" => null, "p" => array("style" => 'text-align: center;'));
    $row["c"][3]= array("v" => strval($entry["result"]), "f" => null, "p" => array("style" => 'text-align: center;'));
    $row["c"][4]= array("v" => intval($entry["wave"]), "f" => null, "p" => array("style" => 'text-align: center;'));
    $row["c"][5]= array("v" => strval($entry["timestamp"]), "f" => null, "p" => array("style" => 'text-align: center;'));
    $jsonData["rows"][$index]= $row;
    $index++;
}
echo  $response . json_encode($jsonData) . "});";
?>
