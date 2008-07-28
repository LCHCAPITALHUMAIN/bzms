<?php
include("header.php");
$langarrayofpermissionlist=array("show" => "[lang_cp_show_permission]","hide" =>"[lang_cp_hide_permission]");
switch ($_GET[action])
{
case "":
$sqlofconfig="SELECT * FROM `config` WHERE `site_id` = '1'";
$resultofconfig=mysql_query($sqlofconfig);
$rowofconfig=mysql_fetch_array($resultofconfig);
$sss="$sitemainpath/lang";	
$stylespath="$sitemainpath/templates";
$langfileslist=forms::listofdir($sss,"files",$rowofconfig[site_lang]);
$langstyleslist=forms::listofdir($stylespath,"dirs",$rowofconfig[site_style]);

$filepath="$sitemainpath/templates/$_SESSION[site_style]/cp/config.html";
$lang="$sitemainpath/lang/$_SESSION[site_lang]";
$array=array(
"[temp_form_action]" => "?action=save",
"[page_title]" => "ÊÚÏíá ÇÚÏÇÏÇÊ ÇáãæÞÚ",
"[temp_site_title]" => "$rowofconfig[site_title]",
"[temp_site_footer]" => "$rowofconfig[site_footer]",
"[list_of_langs]" => "$langfileslist",
"[list_of_styles]" => "$langstyleslist",
"[send]" => "ÇÑÓÇá",
"[clear]" => "ÊÝÑíÛ ÇáÍÞæá",
);
$me=$forms->cpanel($filepath,$lang,$array);
echo $me;

break;
case "save":
$sqlsql="UPDATE `config` SET `site_title` = '$_POST[site_title]',
`site_footer` = '$_POST[site_footer]',
`site_lang` = '$_POST[site_lang]',
`site_style` = '$_POST[site_style]' WHERE `site_id` = '1';";
mysql_query($sqlsql);
break;
}
$footer=str_replace("templates/","$sitemainurl/templates/","$footer");
echo $footer;
?>
