<?php
session_start();
include("include/all.php");
$mains->check($sitemainconf[site_style],$sitemainconf[site_lang]);
$head=$templates->header($sitemainconf[site_title],$sitemainpath,$_SESSION[site_style],$_SESSION[site_lang]);
echo $head;
switch ($_GET[action])
{
case "":
$sqlofnews="SELECT * FROM `mails`";
$resultofnews=mysql_query($sqlofnews);
while ($rowofnews=mysql_fetch_array($resultofnews)){
	if ($_GET[depid]==$rowofnews[id]) {
$departments.="<option value=$rowofnews[mail] selected>$rowofnews[title]</option>";		
	}else {
$departments.="<option value=$rowofnews[mail]>$rowofnews[title]</option>";
}}
$filenameofnewsview="mails.html";

$arrayofviewnews=array(
"[temp_form_action]" => "?action=sendmail",
"[list_departments]" => "$departments",
);

$html=$forms->form($sitemainpath,$_SESSION[site_style],$filenameofnewsview,$arrayofviewnews);
$html=$language->language($sitemainpath,$html,$_SESSION[site_lang]);
echo $html;
break;
case "sendmail":
$mailcontent="$lang[mailsubject]";

break;
}

echo $footer;
?>