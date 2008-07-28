<?php
include("header.php");

switch ($action)
{
	case "addform":
$filepath="$sitemainpath/templates/$_SESSION[site_style]/cp/members.html";
$lang="$sitemainpath/lang/$_SESSION[site_lang]";
$langarrayofmemberpermissionlist=array("member"=>"[lang_member_title]","customer"=>"[lang_customer_title]","admin"=>"[lang_admin_title]");
$arrayoflistmemberpermission=forms::memberpermissionlist("",$langarrayofmemberpermissionlist);
$array1=array(
"[temp_form_action]" => "?action=addaccept",
"[temp_m_uname_value]" => "",
"[temp_m_pass_value]" => "",
"[temp_m_mail_value]" => "",
"[temp_m_site_value]" => "",
"[temp_m_country_value]" => "",
"[temp_m_phone_value]" => "",
"[temp_m_address_value]" => "",
"[temp_member_permissions]" => "$arrayoflistmemberpermission",
"[temp_total_orders]" => "[lang_none_orders]",
"[temp_total_payment]" => "[lang_none_payment]",
);
$me=$forms->cpanel($filepath,$lang,$array1);
echo $me;
 break;
 
 case "addaccept":
 if(empty($_POST[m_uname])||empty($_POST[m_pass])||empty($_POST[m_mail])||empty($_POST[m_site])||empty($_POST[m_country])||empty($_POST[m_phone])||empty($_POST[m_address])||empty($_POST[permisssion]))
 {
 echo "<center><b>⁄‰œﬂ Õ«ÃÂ ›«÷Ì…";	
 }
 if($_POST[m_pass])
 {
$md5pass=md5($_POST[m_pass]);
$userchecksql="SELECT * FROM `members` where `m_uname` = '$_POST[m_uname]'";
$usercheckquery=mysql_query($userchecksql);
$usercheckrows=mysql_num_rows($usercheckquery);
if($usercheckrows=="1")
{
	echo"<center><b>«”„ «·„” Œœ„ «·–Ì «œŒ· Â „ÊÃÊœ „”»ﬁ«";
}else{
$qurey="INSERT INTO `members` ( `m_id` , `m_uname` , `m_pass` , `m_mail` , `m_perm` , `m_site` , `m_total_orders` , `m_total_payment` , `m_country` , `m_phone` , `m_address` ) 
VALUES (
'', '$_POST[m_uname]', '$md5pass', '$_POST[m_mail]', '$_POST[permisssion]', '$_POST[m_site]', '0', '0', '$_POST[m_country]', '$_POST[m_phone]', '$_POST[m_address]'
);";
$sqlsql=mysql_query($qurey);
echo"<center><b>‘ﬂ—« ·ﬂ  „ «· ”ÃÌ· »‰Ã«Õ ”Ì „ „—«”· ﬂ »»—Ìœ «·ﬂ —Ê‰Ì ›ÌÂ »Ì«‰«  «· ”ÃÌ·";
$subject="<br>Thanks For Register Mr/Miss $_POST[m_uname] U Can Login To Our Members System From <a href=$sitemainurl/login.php?action=loginform>$sitemainurl/login.php?action=loginform</a> <br>Your Account Name :$_POST[m_uname] <br> Your Account Password : The Password That You Type In Register Form";
mail($_POST[m_mail],"Thanks For Register","");
}}else{
 	echo "<center><b>ﬂ·„… «·”—Ê ﬂ—«— ﬂ·„… «·”— €Ì— „ ‘«»Â«‰ —Ã«¡ «·⁄Êœ… Êﬂ «» Â« „—Â «Œ—Ì";
 }
 break;
}
echo $footer;
?>
