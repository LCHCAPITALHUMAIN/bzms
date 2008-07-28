<?php
include("header.php");
$langarrayofpermissionlist=array("show" => "[lang_cp_show_permission]","hide" =>"[lang_cp_hide_permission]");
switch ($_GET[action])
{
case "addform":

$catsubbs=$forms->catsub();
$filepath="$sitemainpath/templates/$_SESSION[site_style]/cp/productform.html";
$lang="$sitemainpath/lang/$_SESSION[site_lang]";
$wysiwyg=$forms->wysiwyg($sitemainurl,Form1,pro_text,"");
$permissionlist=forms::productpermissions($rowrow3[pro_permission],$langarrayofpermissionlist);
$array=array(
"[form_action]" => "?action=addaccept",
"[page_title]" => "ÇÖÇÝÉ ãäÊÌ ÌÏíÏ",
"[temp_pro_title_value]" => "",
"[temp_pro_img_value]" => "",
"[temp_pro_price_value]" => "",
"[temp_pro_permission_value]" => "$permissionlist",
"[subcat_subcat]" => "$catsubbs",
"[temp_pro_text]" => "$wysiwyg",
"[send]" => "ÇÑÓÇá",
"[clear]" => "ÊÝÑíÛ ÇáÍÞæá",
);
$me=$forms->cpanel($filepath,$lang,$array);
echo $me;
break;

case "addaccept":
$sqlsql="INSERT INTO `product` ( `pro_id` , `pro_title` , `pro_sid` , `pro_text` , `pro_date` , `pro_view_num` , `pro_order_num` , `pro_img` , `pro_price` , `pro_permission` )
VALUES ('', '$_POST[title]', '$_POST[sid]', '$_POST[pro_text]', '$datess', '0', '0', '$_POST[img]', '$_POST[price]', '$_POST[permission]');";
$queryquery=mysql_query($sqlsql);
if ($queryquery==0) {
	die("ßÏå ãÔ ÊãÇã");
}else {
echo "Done";
}
$selectcat="SELECT * FROM `services` where `serv_id`= '$_POST[sid]';";
$selectcatquery=mysql_query($selectcat);
$selectcatrow=mysql_fetch_array($selectcatquery);
$sss=$selectcatrow[serv_item_num]+1;
echo $sss;
$sqlcat="UPDATE `services` SET `serv_item_num` = '$sss' WHERE `serv_id` = '$selectcatrow[serv_id]';";
$queryofsqlcat=mysql_query($sqlcat);

break;

case "edit":
if (!isset($_GET[proid])) {
	echo "áã ÊÞã ÈÃÎÊíÇÑ ãäÊÌ";
}else {
$sqlsql3="SELECT * FROM `product` WHERE `pro_id` = '$_GET[proid]'";
$queryquery3=$forms->makesql($sqlsql3);
$rowrow3=mysql_fetch_array($queryquery3);
$filepath3="$sitemainpath/templates/$_SESSION[site_style]/cp/productform.html";
$lang3="$sitemainpath/lang/$_SESSION[site_lang]";	
$catsubbs3=forms::editcatsub($rowrow3[pro_sid]);
$productpermissionlist=forms::productpermissions($rowrow3[pro_permission],$langarrayofpermissionlist);
$editwysiwyg=$forms->wysiwyg($sitemainurl,Form1,pro_text,$rowrow3[pro_text]);
$array3=array(
"[form_action]" => "?action=update&proid=$rowrow3[pro_id]",
"[page_title]" => "ÊÚÏíá ãäÊÌ",
"[temp_pro_title_value]" => "$rowrow3[pro_title]",
"[temp_pro_img_value]" => "$rowrow3[pro_img]",
"[temp_pro_price_value]" => "$rowrow3[pro_price]",
"[temp_pro_permission_value]" => "$productpermissionlist",
"[subcat_subcat]" => "$catsubbs3",
"[temp_pro_text]" => "$editwysiwyg",
"[send]" => "ÇÑÓÇá",
"[clear]" => "ÊÝÑíÛ ÇáÍÞæá",
);
$me3=$forms->cpanel($filepath3,$lang3,$array3);
echo "$me3";
}
break;

case "update":
if(!isset($_GET[proid]))
{
echo "ãÔ ÊÑæÍ ÊÎÊÇÑ ãäÊÌ ÇáÇæá æÈÚÏ ßÏå ÊÚÏá Úáíå¿";
}else {
$sqlsql4="UPDATE `product` SET `pro_title` = '$_POST[title]',
`pro_sid` = '$_POST[sid]',
`pro_text` = '$_POST[pro_text]',
`pro_img` = '$_POST[img]',
`pro_price` = '$_POST[price]',
`pro_permission` = '$_POST[permission]' WHERE `pro_id` = '$_GET[proid]';";
$queryquery4=mysql_query($sqlsql4);
if ($queryquery4==0) {
	echo "áã íÊã ÇáÇÓÊÚáÇã ÈÔßá ÌíÏ íÇ ÍãÕ";
}else {
echo "Done";
}
}
break;
case "delete":
if (!isset($_GET[proid])) {
	echo "ãÔ ÊÑæÍ ÊÎÊÇÑáß ãäÊÌ ÇáÇæá";
}else {
$delsql="DELETE FROM `product` WHERE `pro_id` = '$_GET[proid]'";
$delquery=forms::makesql($delsql);
if ($delquery==0) {
	echo "áã íÊã ÍÐÝ ÇáãäÊÌ ÈäÌÇÍ";
}else {
 echo "Êã ÇáÍÐÝ ÈäÌÇÍ";
}}
break;
}
echo $footer;
?>
