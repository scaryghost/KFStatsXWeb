<?php

$kfstatsx= simplexml_load_file('http://127.0.0.1:8080/index.xml');
$result= $kfstatsx->xpath("stats[@category='totals']");

$html= "<center><table width='630' cellspacing='6' cellpadding='0'><tbody>";
foreach($result[0] as $entry) {
    $html= $html . "<tr><td>" . $entry['name'] . "</td><td>" . $entry['value'] . "</td></tr>";
}
$html= $html . "</tbody></table></center>";
echo $html;
?>
