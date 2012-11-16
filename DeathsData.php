<?php
$stats= simplexml_load_file('http://127.0.0.1:8080/index.xml');
$result= $stats->xpath("stats[@category='deaths']");

$jsonData= array();
$jsonData["cols"]= array(array("label" => "Death", "type" => "string"), array("label" => "Count", "type" => "number"));
$jsonData["rows"]= array();
$index= 0;

foreach($result[0] as $death) {
    $row= array();

    $row["c"]= array();
    $row["c"][0]= array("v" => strval($death["name"]), "f" => null);
    $row["c"][1]= array("v" => intval($death["value"]), "f" => null);
    $jsonData["rows"][$index]= $row;
    $index++;
}

echo  json_encode($jsonData);
?>
