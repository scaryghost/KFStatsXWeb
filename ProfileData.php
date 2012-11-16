<?php


$steamid64= $_REQUEST['steamid64'];
$category= $_REQUEST['category'];

//$steamid64="76561198041060328";
//$category="kills";
$kfstatsx= simplexml_load_file('http://127.0.0.1:8080/profile.xml?steamid64=' . $steamid64);
$result= $kfstatsx->profile->xpath("stats[@category='" . $category . "']");
$jsonData= array();

$jsonData["cols"]= array(array("label" => "Stat", "type" => "string"), array("label" => "Value", "type" => "number"));
$jsonData["rows"]= array();
$index= 0;
foreach($result[0] as $aggr) {
    $row= array();
    $name= strval($aggr["name"]);

    $row["c"]= array();
    $row["c"][0]= array("v" => $name, "f" => null);
    if ($category == "perks") {
        $row["c"][1]= array("v" => intval($aggr["value"]), "f" => strval($aggr["hint"]));
    } else if(strpos($name,'Time') !== false) {
        $row["c"][1]= array("v" => 0, "f" => strval($aggr["value"]));
    } else {
        $row["c"][1]= array("v" => intval($aggr["value"]), "f" => null);
    }
    $jsonData["rows"][$index]= $row;
    $index++;
}

echo  json_encode($jsonData);
?>
