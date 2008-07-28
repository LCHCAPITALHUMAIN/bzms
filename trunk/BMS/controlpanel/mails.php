<?php
include("header.php");
$langarrayofpermissionlist=array("show" => "[lang_cp_show_permission]","hide" =>"[lang_cp_hide_permission]");
switch ($_GET[action])
{
case "addform":
$filepath="$sitemainpath/templates/$_SESSION[site_style]/cp/mails.html";
$lang="$sitemainpath/lang/$_SESSION[site_lang]";
$array=array(
"[temp_form_action]" => "?action=addaccept",
"[page_title]" => "«÷«›… »—Ìœ «·ﬂ —Ê‰Ì ·«œ«—…",
"[temp_mail_title]" => "",
"[temp_mail_mail]" => "",
"[send]" => "«—”«·",
"[clear]" => " ›—Ì€ «·ÕﬁÊ·",
);
$me=$forms->cpanel($filepath,$lang,$array);
echo $me;
break;

case "addaccept":
$sqlsql="INSERT INTO `mails` ( `id` , `title` , `mail` )
VALUES (
'', '$_POST[title]', '$_POST[mail]'
);
";
$queryquery=mysql_query($sqlsql);
if ($queryquery==0) {
	die("Œÿ√!");
}else {
echo "Done";
}

break;

case "edit":
if (!isset($_GET[id])) {
	echo "·„  ﬁ„ »√Œ Ì«— „‰ Ã";
}else {
$sqlsql3="SELECT * FROM `mails` WHERE `id` = '$_GET[id]'";
$queryquery3=$forms->makesql($sqlsql3);
$rowrow3=mysql_fetch_array($queryquery3);
$filepath3="$sitemainpath/templates/$_SESSION[site_style]/cp/mails.html";
$lang3="$sitemainpath/lang/$_SESSION[site_lang]";
$array3=array(
"[temp_form_action]" => "?action=update&id=$rowrow3[id]",
"[page_title]" => " ⁄œÌ· »—Ìœ «·ﬂ —Ê‰Ì ·«œ«—Â",
"[temp_mail_title]" => "$rowrow3[title]",
"[temp_mail_mail]" => "$rowrow3[mail]",
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
	echo "·„ Ì „ «·«” ⁄·«„ »‘ﬂ· ÃÌœ";
}else {
echo "Done";
}
}
break;
case "delete":
if (!isset($_GET[id])) {
	echo "Œÿ√!";
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
$sqlofshow="SELECT * FROM `mails`";
$resultofshow=mysql_query($sqlofshow);
$showhtml="<table border=1 width=100% dir=rtl><tr><td>Department  /  Mail</td><td>Options</td></tr>";
while ($rowofshow=mysql_fetch_array($resultofshow)) {
	$showhtml.="<tr><td>$rowofshow[title]  /  $rowofshow[mail]</td><td><a href=?action=edit&id=$rowofshow[id]>Edit</a>\\\<a href=?action=delete&id=$rowofshow[id]>Delete</a></td></tr>";
}
$showhtml.="</table>";
echo $showhtml;
break;
}
echo $footer;
?>
