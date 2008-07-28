<?php
session_start();
include("include/all.php");
$mains->check($sitemainconf[site_style],$sitemainconf[site_lang]);
$head=$templates->header($sitemainconf[site_title],$sitemainpath,$_SESSION[site_style],$_SESSION[site_lang]);
echo $head;
members::checkpermission(2);
switch ($_GET[action])
{
case "":
$html="<b><center>FAQ<br>";
$sqlofcustomers="SELECT * FROM `faq` ORDER BY `date` DESC ";
$resultofcustomers=mysql_query($sqlofcustomers);
$html.="<table dir=rtl><tr><td>ÚäæÇä ÇáÓÄÇá</td><td>ÊÇÑíÎ ÇáÓÄÇá</td></tr>";
while ($rowofcustomers=mysql_fetch_array($resultofcustomers)) {
$html.="<tr><td><a href=?action=show&id=$rowofcustomers[id]>$rowofcustomers[title]</a></td><td>$rowofcustomers[date]</td></tr>";
}
$html.="</table>";
echo $html;
break;
case "show":
$sqlofnews="SELECT * FROM `faq` WHERE `id` = '$_GET[id]'";
$resultofnews=mysql_query($sqlofnews);
$rowofnews=mysql_fetch_array($resultofnews);
$filenameofnewsview="viewnews.html";

$arrayofviewnews=array(
"[temp_news_title]" => "$rowofnews[title]",
"[temp_news_date]" => "$rowofnews[date]",
"[temp_news_txt]" => "$rowofnews[txt]"
);

$html=$forms->form($sitemainpath,$_SESSION[site_style],$filenameofnewsview,$arrayofviewnews);
$html=$language->language($sitemainpath,$html,$_SESSION[site_lang]);
echo $html;
break;
}

echo $footer;
?>
