<?php
session_start();
include("include/all.php");
$mains->check($sitemainconf[site_style],$sitemainconf[site_lang]);
$head=$templates->header($sitemainconf[site_title],$sitemainpath,$_SESSION[site_style],$_SESSION[site_lang]);
echo $head;

$filenameofnewsview="index_main_panel.html";

$arrayofviewnews=array(
"[temp_form_action]" => "?action=sendmail",
"[list_departments]" => "$departments",
);

$html=$forms->form($sitemainpath,$_SESSION[site_style],$filenameofnewsview,$arrayofviewnews);
if (session_is_registered(member_name)) {
$html=str_replace("[lang_index_login]","[lang_index_logout]","$html");
}
$html=$language->language($sitemainpath,$html,$_SESSION[site_lang]);
echo $html;


echo $footer;
?>