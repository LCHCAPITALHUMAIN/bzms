<?php
include("header.php");
$langarrayofpermissionlist=array("show" => "[lang_cp_show_permission]","hide" =>"[lang_cp_hide_permission]");
switch ($_GET[action])
{
case "addform":

$catsubbs=$forms->catsub();
$filepath="$sitemainpath/templates/$_SESSION[site_style]/cp/newsform.html";
$lang="$sitemainpath/lang/$_SESSION[site_lang]";
$wysiwyg=$forms->wysiwyg($sitemainurl,Form1,text,"");
$array=array(
"[form_action]" => "?action=addaccept",
"[page_title]" => "����� ��� ����",
"[temp_news_title_value]" => "",
"[temp_news_text]" => "$wysiwyg",
"[send]" => "�����",
"[clear]" => "����� ������",
);
$me=$forms->cpanel($filepath,$lang,$array);
echo $me;
break;

case "addaccept":
$sqlsql="INSERT INTO `faq` ( `id` , `date` , `title` , `txt` )
VALUES ('', '$datess', '$_POST[title]', '$_POST[text]');";
$queryquery=mysql_query($sqlsql);
if ($queryquery==0) {
	die("��� �� ����");
}else {
echo "Done";
}

break;

case "edit":
if (!isset($_GET[id])) {
	echo "�� ��� ������� ����";
}else {
$sqlsql3="SELECT * FROM `faq` WHERE `id` = '$_GET[id]'";
$queryquery3=$forms->makesql($sqlsql3);
$rowrow3=mysql_fetch_array($queryquery3);
$filepath3="$sitemainpath/templates/$_SESSION[site_style]/cp/newsform.html";
$lang3="$sitemainpath/lang/$_SESSION[site_lang]";
$editwysiwyg=$forms->wysiwyg($sitemainurl,Form1,text,$rowrow3[txt]);
$array3=array(
"[form_action]" => "?action=update&id=$rowrow3[id]",
"[page_title]" => "����� ����",
"[temp_news_title_value]" => "$rowrow3[title]",
"[temp_news_text]" => "$editwysiwyg",
"[send]" => "�����",
"[clear]" => "����� ������",
);
$me3=$forms->cpanel($filepath3,$lang3,$array3);
echo "$me3";
}
break;

case "update":
if(!isset($_GET[id]))
{
echo "�� ���� ����� ���� ����� ���� ��� ���� ����";
}else {
$sqlsql4="UPDATE `faq` SET `title` = '$_POST[title]',
`txt` = '$_POST[text]' WHERE `id` = '$_GET[id]';";
$queryquery4=mysql_query($sqlsql4);
if ($queryquery4==0) {
	echo "�� ��� ��������� ���� ��� �� ���";
}else {
echo "Done";
}
}
break;
case "delete":
if (!isset($_GET[id])) {
	echo "�� ���� ������� ���� �����";
}else {
$delsql="DELETE FROM `faq` WHERE `id` = '$_GET[id]'";
$delquery=forms::makesql($delsql);
if ($delquery==0) {
	echo "�� ��� ��� ������ �����";
}else {
 echo "�� ����� �����";
}}
break;

case "show":
$sqlofshow="SELECT * FROM `faq`";
$resultofshow=mysql_query($sqlofshow);
$showhtml="<table border=1 width=100% dir=rtl><tr><td>News Title</td><td>Options</td></tr>";
while ($rowofshow=mysql_fetch_array($resultofshow)) {
	$showhtml.="<tr><td>$rowofshow[title]</td><td><a href=?action=edit&id=$rowofshow[id]>Edit</a>\\\<a href=?action=delete&id=$rowofshow[id]>Delete</a></td></tr>";
}
$showhtml.="</table>";
echo $showhtml;
break;
}
echo $footer;
?>
