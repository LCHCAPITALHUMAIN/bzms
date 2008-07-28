<?php
session_start();
include("include/all.php");
$mains->check($sitemainconf[site_style],$sitemainconf[site_lang]);
$head=$templates->header($sitemainconf[site_title],$sitemainpath,$_SESSION[site_style],$_SESSION[site_lang]);
echo $head;
if(session_is_registered(member_name))
{
switch ($action)
{
case "controlpanel":
echo "<a href=?action=orderslist>Orderslist</a><br>";
echo "<a href=?action=membercp>Edit Your Options</a><br>";
echo "<a href=?action=changepassword>Change Password</a>";
echo "<table><tr><td><a href=tickets.php?action=newticket><img border=0 src=images/newticket.gif></a></td></tr></table>";
break;

case "orderslist":
$selectorders="SELECT * FROM `orders` where `order_member_name` = '$_SESSION[member_name]' ORDER BY `order_status`";
$queryorders=mysql_query($selectorders);
if(mysql_num_rows($queryorders)==0){
echo "·„  ﬁ„ »⁄„· ÿ·»«  »⁄œ";
}else{
while ($roworders=mysql_fetch_array($queryorders)) {
$selectyawad=$product->productselect($roworders[order_pro_id]);
$rowsofproduct=mysql_fetch_array($selectyawad);
$filename="orderview.html";
$orderstatuschar=members::checkorderstatus($roworders[order_status]);
$acceptarray=array(
"[temp_product_img]" => "images/productimg/$rowsofproduct[pro_img]",
"[temp_product_title]" => "$rowsofproduct[pro_title]",
"[temp_order_pro_num]" => "$roworders[order_pro_num]",
"[temp_product_price]" => "$roworders[order_pro_price]",
"[temp_member_name]" => "$roworders[order_member_name]",
"[temp_order_total_price]" => "$roworders[order_total_price]",
"[temp_order_status]" => "$orderstatuschar"
);
$orderaccepthtmltempreplace=$forms->form($sitemainpath,$_SESSION[site_style],$filename,$acceptarray);
$orderaccepthtmltempreplace=$language->language($sitemainpath,$orderaccepthtmltempreplace,$_SESSION[site_lang]);
echo $orderaccepthtmltempreplace;
}
}
break;

case "membercp":
$selectthemember="SELECT * FROM `members` where `m_uname` = '$_SESSION[member_name]'";
$resultofmember=mysql_query($selectthemember);
$rowofmember=mysql_fetch_array($resultofmember);
$regtemplatefile="memberoptionsform.html";

$arrayofregform=array(
"[temp_form_action]" => "?action=updateoptions",
"[temp_m_uname_value]" => "$rowofmember[m_uname]",
"[temp_m_pass_value]" => "",
"[temp_m_mail_value]" => "$rowofmember[m_mail]",
"[temp_m_site_value]" => "$rowofmember[m_site]",
"[temp_m_country_value]" => "$rowofmember[m_country]",
"[temp_m_phone_value]" => "$rowofmember[m_phone]",
"[temp_m_address_value]" => "$rowofmember[m_address]",
);

$gg=$forms->form($sitemainpath,$_SESSION[site_style],$regtemplatefile,$arrayofregform);
$gg=$language->language($sitemainpath,$gg,$_SESSION[site_lang]);
echo $gg;
break;

case "updateoptions":
$sqlofupdatemember="UPDATE `members` SET `m_mail` = '$_POST[m_mail]',
`m_site` = '$_POST[m_site]',
`m_country` = '$_POST[m_country]',
`m_phone` = '$_POST[m_phone]',
`m_address` = '$_POST[m_address]' WHERE `m_uname` = '$_SESSION[member_name]'";
$resultofupdatemember=mysql_query($sqlofupdatemember);
if ($resultofupdatemember==1) {
echo " „ Õ›Ÿ «·»Ì«‰«  »‰Ã«Õ";	
}

break;

case "changepassword":

$changepassfile="changepasswordform.html";

$arrayofchangepassform=array(
"[temp_form_action]" => "?action=updatepassword",
);

$ff=$forms->form($sitemainpath,$_SESSION[site_style],$changepassfile,$arrayofchangepassform);
$ff=$language->language($sitemainpath,$ff,$_SESSION[site_lang]);
echo $ff;
break;

case "updatepassword":
$md5newpasspass=md5("$_POST[m_pass]");
echo $md5newpasspass;
$sqlofchangepass="UPDATE `members` SET `m_pass` = '$md5newpasspass' WHERE `m_uname` = '$_SESSION[member_name]';";
$resultofchangepass=mysql_query($sqlofchangepass);
if ($resultofchangepass==1) {
echo " „  €ÌÌ— ﬂ·„… «·”— »‰Ã«Õ";	
echo "<meta http-equiv=Refresh content=2;URL=login.php?action=logout>";
}else {
echo "·„ Ì „  €ÌÌ— ﬂ·„… «·”— »‰Ã«Õ";
}
break;
}
}else {
echo "·„  ﬁ„ » ”ÃÌ· «·œŒÊ· »⁄œ";
echo "<meta http-equiv=Refresh content=2;URL=login.php?action=loginform>";
}
echo $footer;
?>
