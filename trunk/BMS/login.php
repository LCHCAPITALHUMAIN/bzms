<?php
session_start();
include("include/all.php");
$mains->check($sitemainconf[site_style],$sitemainconf[site_lang]);
$head=$templates->header($sitemainconf[site_title],$sitemainpath,$_SESSION[site_style],$_SESSION[site_lang]);
echo $head;

switch($action)
{
case"loginform":
if(session_is_registered(member_name))
{
	echo "<b><center>you Are Already Login $_SESSION[member_name]";
	break;
}
$regtemplatefile="loginform.html";

$arrayofloginform=array(
"[temp_form_action]" => "?action=logincheck",
"[temp_m_uname_value]" => "",
"[temp_m_pass_value]" => "",
);

$gg=$forms->form($sitemainpath,$_SESSION[site_style],$regtemplatefile,$arrayofloginform);
$gg=$language->language($sitemainpath,$gg,$_SESSION[site_lang]);
echo $gg;

break;
///////////////////////////////////////////////////////////
case"logincheck":
if(session_is_registered(member_name))
{
	echo "<b><center>you Are Already Login $_SESSION[member_name]";
	echo "<meta http-equiv=Refresh content=2;URL=index.php>";
	break;
}
if(empty($_POST[m_uname])||empty($_POST[m_pass]))
 {
 echo "<center><b>·„  ﬁ„ »„·«¡ Ã„Ì⁄ «·ÕﬁÊ·";	
 }else{
$passwordlogin=md5("$_POST[m_pass]");
$qurey="SELECT * FROM `members` where `m_uname` = '$_POST[m_uname]' && `m_pass`= '$passwordlogin'";
$sqlsqls=mysql_query($qurey);
$rowssss=mysql_num_rows($sqlsqls);
if($rowssss=='0')
{
 	echo "<center><b>«”„ «·„” Œœ„ «Ê ﬂ·„… «·”— Œÿ√";
 	echo "<meta http-equiv=Refresh content=2;URL=?action=loginform>";
}else{
echo"<center><b>·ﬁœ  „  ”ÃÌ· «·œŒÊ· »‰Ã«Õ";
echo "<meta http-equiv=Refresh content=2;URL=members.php?action=controlpanel>";
session_register("member_name");
$_SESSION[member_name]=$_POST[m_uname];
}
}
break;
////////////////////////////////////////////////////////////
}
switch($action)
{
case "logout":
if(session_is_registered("member_name"))
{
	session_unregister("member_name");
	session_destroy();
echo "<b><center>Logout Done";
echo "<meta http-equiv=Refresh content=2;URL=?action=loginform>";
}else{echo "<b><center>You Already Didn't Login";}
break;
}


echo $footer;
?>