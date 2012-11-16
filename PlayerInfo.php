<?php

$steamid64= $_REQUEST['steamid64'];

$kfstatsx= simplexml_load_file('http://127.0.0.1:8080/profile.xml?steamid64=' . $steamid64);

$html= "<center><table width='630' cellspacing='6' cellpadding='0'>";
$html= $html . "<tbody><tr><td>Name</td><td>" . $kfstatsx->profile['name'] . "</td></tr>";
$html= $html . "<tr><td>Wins</td><td>" . $kfstatsx->profile['wins'] . "</td><td rowspan='4'><img src='" . $kfstatsx->profile['avatar'] . "' /></td>";
$html= $html . "</tr><tr><td>Losses</td><td>" . $kfstatsx->profile['losses'] . "</td></tr><tr><td>Disconnects</td>";
$html= $html . "<td>" . $kfstatsx->profile['disconnects'] . "</td></tr><tr><td>Steam Community</td><td><a target='_blank' href='";
$html= $html . "http://steamcommunity.com/profiles/" . $kfstatsx->profile['steamid64'] . "'>" . $kfstatsx->profile['steamid64'] . "</a></td>";
$html= $html . "</tr></tbody></table></center>";

echo $html;
?>
