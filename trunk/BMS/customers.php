<?php
session_start();
include("include/all.php");
$mains->check($sitemainconf[site_style],$sitemainconf[site_lang]);
$head=$templates->header($sitemainconf[site_title],$sitemainpath,$_SESSION[site_style],$_SESSION[site_lang]);
echo $head;

$html="<b><center>$lang[customerphp_cuslist]<br>";
$sqlofcustomers="SELECT *FROM `customers`";
$resultofcustomers=mysql_query($sqlofcustomers);
while ($rowofcustomers=mysql_fetch_array($resultofcustomers)) {
$html.="<a target=_blank href=$rowofcustomers[url]><img alt=\"$rowofcustomers[title]\" width=175 hight=300 border=0 src=images/customersimg/$rowofcustomers[image]></a>";
}
echo $html;

echo $footer;
?>
