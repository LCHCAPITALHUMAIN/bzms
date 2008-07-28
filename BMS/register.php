<?php
session_start();
include("include/all.php");
$mains->check($sitemainconf[site_style],$sitemainconf[site_lang]);
$head=$templates->header($sitemainconf[site_title],$sitemainpath,$_SESSION[site_style],$_SESSION[site_lang]);
echo $head;
switch ($action)
{
	case "":
$regtemplatefile="registerform.html";

$arrayofregform=array(
"[temp_form_action]" => "?action=registeraccept",
"[temp_m_uname_value]" => "",
"[temp_m_pass_value]" => "",
"[temp_m_mail_value]" => "",
"[temp_m_site_value]" => "",
"[temp_m_country_value]" => "",
"[temp_m_phone_value]" => "",
"[temp_m_address_value]" => "",
);

$gg=$forms->form($sitemainpath,$_SESSION[site_style],$regtemplatefile,$arrayofregform);
$gg=$language->language($sitemainpath,$gg,$_SESSION[site_lang]);
echo $gg;
 break;
 
 case "registeraccept":
 if(empty($_POST[m_uname])||empty($_POST[m_pass])||empty($_POST[m_mail])||empty($_POST[m_site])||empty($_POST[m_country])||empty($_POST[m_phone])||empty($_POST[m_address]))
 {
 echo "<center><b>⁄‰œﬂ Õ«ÃÂ ›«÷Ì…";	
 }
 if($_POST[m_pass]==$_POST[re_pass])
 {
$md5pass=md5($_POST[m_pass]);
$userchecksql="SELECT * FROM `members` where `m_uname` = '$_POST[m_uname]'";
$usercheckquery=mysql_query($userchecksql);
$usercheckrows=mysql_num_rows($usercheckquery);
if($usercheckrows=="1")
{
	echo"<center><b>«·ÌÊ“— œÂ „ÊÃÊœ ﬁ»· ﬂœÂ Ì« —Ì”";
}else{
$qurey="INSERT INTO `members` ( `m_id` , `m_uname` , `m_pass` , `m_mail` , `m_perm` , `m_site` , `m_total_orders` , `m_total_payment` , `m_country` , `m_phone` , `m_address` ) 
VALUES (
'', '$_POST[m_uname]', '$md5pass', '$_POST[m_mail]', '1', '$_POST[m_site]', '0', '0', '$_POST[m_country]', '$_POST[m_phone]', '$_POST[m_address]'
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