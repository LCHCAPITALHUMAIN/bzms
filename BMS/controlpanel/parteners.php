<?php
include("header.php");
$langarrayofpermissionlist=array("show" => "[lang_cp_show_permission]","hide" =>"[lang_cp_hide_permission]");
switch ($_GET[action])
{
case "addform":
$filepath="$sitemainpath/templates/$_SESSION[site_style]/cp/parteners.html";
$lang="$sitemainpath/lang/$_SESSION[site_lang]";
$array=array(
"[form_action]" => "?action=addaccept",
"[page_title]" => "«÷«›… ⁄„Ì·  ÃœÌœ",
"[temp_cus_title_value]" => "",
"[temp_cus_url_value]" => "",
"[temp_cus_img_value]" => "",
"[send]" => "«—”«·",
"[clear]" => " ›—Ì€ «·ÕﬁÊ·",
);
$me=$forms->cpanel($filepath,$lang,$array);
echo $me;
break;

case "addaccept":
$sqlsql="INSERT INTO `parteners` ( `id` , `image` , `title` , `url` )
VALUES ('', '$_POST[img]', '$_POST[title]', '$_POST[url]');";
$queryquery=mysql_query($sqlsql);
if ($queryquery==0) {
	die("ﬂœÂ „‘  „«„");
}else {
echo "Done";
}

break;

case "edit":
if (!isset($_GET[id])) {
	echo "·„  ﬁ„ »√Œ Ì«— „‰ Ã";
}else {
$sqlsql3="SELECT * FROM `parteners` WHERE `id` = '$_GET[id]'";
$queryquery3=$forms->makesql($sqlsql3);
$rowrow3=mysql_fetch_array($queryquery3);
$filepath3="$sitemainpath/templates/$_SESSION[site_style]/cp/parteners.html";
$lang3="$sitemainpath/lang/$_SESSION[site_lang]";
$editwysiwyg=$forms->wysiwyg($sitemainurl,Form1,text,$rowrow3[txt]);
$array3=array(
"[form_action]" => "?action=update&id=$rowrow3[id]",
"[page_title]" => " ⁄œÌ· „‰ Ã",
"[temp_cus_title_value]" => "$rowrow3[title]",
"[temp_cus_url_value]" => "$rowrow3[url]",
"[temp_cus_img_value]" => "$rowrow3[image]",
"[send]" => "«—”«·",
"[clear]" => " ›—Ì€ «·ÕﬁÊ·",
);
$me3=$forms->cpanel($filepath3,$lang3,$array3);
echo "$me3";
}
break;

case "update":
if(!isset($_GET[id]))
{
echo "„‘  —ÊÕ  Œ «— „‰ Ã «·«Ê· Ê»⁄œ ﬂœÂ  ⁄œ· ⁄·ÌÂø";
}else {
$sqlsql4="UPDATE `parteners` SET `title` = '$_POST[title]',
`image` = '$_POST[img]' , `url` = '$_POST[url]' WHERE `id` = '$_GET[id]';";
$queryquery4=mysql_query($sqlsql4);
if ($queryquery4==0) {
	echo "·„ Ì „ «·«” ⁄·«„ »‘ﬂ· ÃÌœ Ì« Õ„’";
}else {
echo "Done";
}
}
break;
case "delete":
if (!isset($_GET[id])) {
	echo "„‘  —ÊÕ  Œ «—·ﬂ „‰ Ã «·«Ê·";
}else {
$delsql="DELETE FROM `parteners` WHERE `id` = '$_GET[id]'";
$delquery=forms::makesql($delsql);
if ($delquery==0) {
	echo "·„ Ì „ Õ–› «·„‰ Ã »‰Ã«Õ";
}else {
 echo " „ «·Õ–› »‰Ã«Õ";
}}
break;

case "show":
$sqlofshow="SELECT * FROM `parteners`";
$resultofshow=mysql_query($sqlofshow);
$showhtml="<table border=1 width=100% dir=rtl><tr><td>Customers</td><td>Options</td></tr>";
while ($rowofshow=mysql_fetch_array($resultofshow)) {
	$showhtml.="<tr><td>$rowofshow[title]</td><td><a href=?action=edit&id=$rowofshow[id]>Edit</a>\\\<a href=?action=delete&id=$rowofshow[id]>Delete</a></td></tr>";
}
$showhtml.="</table>";
echo $showhtml;
break;
}
echo $footer;
?>
