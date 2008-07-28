<?php
class template
{
function header($title,$sitemainpath,$style,$lang)
{

$filename = "$sitemainpath/templates/$style/header.htm";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

$langu=new lang();
$contents=$langu->language($sitemainpath,$contents,$lang);
$contents=str_replace("[temp_site_title]","$title",$contents);


$memb=new members();
$ishere=$memb->checkhere();
if($ishere=="1")
{
$much=$memb->checkmuch($_SESSION[member_name]);
}elseif($ishere=="0")
{
$navbarhtml="<a href=login.php?action=loginform>[lang_login_word]</a>-<a href=register.php>[lang_register_word]</a>-<a href=forgetpass.php>[lang_forgetpassword_word]</a>";
}
if ($much=="1")
{
$navbarhtml="<a href=members.php?action=controlpanel>[lang_controlpanel]</a>-<a href=login.php?action=logout>[lang_logout_word]</a>";	
}elseif ($much=="2")
{
$navbarhtml="<a href=members.php?action=controlpanel>[lang_controlpanel]</a>-<a href=orders.php?action=listorders>[lang_orders]</a>";	
}elseif ($much=="3")
{
$navbarhtml="<a href=members.php?action=controlpanel>[lang_controlpanel]</a>-<a href=admin.php>[lang_admincp]</a>";	
}
$navbarhtml=$langu->language($sitemainpath,$navbarhtml,$lang);

$contents=str_replace("[temp_site_nav_bar]","",$contents); 
return $contents;
}


function footer($footer,$sitemainpath,$style,$lang)
{
$filename = "$sitemainpath/templates/$style/footer.html";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

$langu=new lang();
$contents=$langu->language($sitemainpath,$contents,$lang);
$contents=str_replace("[temp_site_footer]","$footer",$contents);
return $contents;
}
}
?>
