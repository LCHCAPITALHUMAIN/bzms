<?php
session_start();
include("../include/all.php");
$mains->check($sitemainconf[site_style],$sitemainconf[site_lang]);
$head=$templates->header($sitemainconf[site_title],$sitemainpath,$_SESSION[site_style],$_SESSION[site_lang]);
$head=str_replace("templates/","$sitemainurl/templates/","$head");
echo $head;
$footer=str_replace("templates/","$sitemainurl/templates/","$footer");


members::checkpermission(3);

$filepath="$sitemainpath/templates/$_SESSION[site_style]/cp/index_main_panel.html";
$lang="$sitemainpath/lang/$_SESSION[site_lang]";

$array=array(
"[temp_form_action]" => "?action=sendmail",
"[list_departments]" => "$departments",
);

$html=$forms->cpanel($filepath,$lang,$array);
$html=str_replace("images/icons/","$sitemainurl/images/icons/","$html");
echo $html;



?>
