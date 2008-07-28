<?php
include("header.php");
members::checkpermission(2);
switch ($_GET[action]) {
	case "":
	$sqlofviewtickets="SELECT * FROM `tickets` WHERE `tid` = '0' ORDER BY `id` DESC";
	$resultofviewtickets=mysql_query($sqlofviewtickets);
if (mysql_num_rows($resultofviewtickets)==0) {
echo "·« ÌÊÃœ »ÿ«ﬁ«  „› ÊÕ…";
echo "<meta http-equiv=Refresh content=2;URL=members.php?action=controlpanel>";		
	}else {
$filenameofviewtickets="viewticket.html";
while ($rowofviewtickets=mysql_fetch_array($resultofviewtickets)) {
$arrayofviewtickets=array(
"[temp_ticket_subject_value]" => "$rowofviewtickets[subject]",
"[temp_ticket_text_value]" => "$rowofviewtickets[txt]",
"[temp_ticket_view_url]" => "?action=view&tid=$rowofviewtickets[id]",
"[temp_date_of_ticket]" => "$rowofviewtickets[date]"
);
$viewticketsvar.=$forms->form($sitemainpath,$_SESSION[site_style],$filenameofviewtickets,$arrayofviewtickets);

}
$viewticketsvar=$language->language($sitemainpath,$viewticketsvar,$_SESSION[site_lang]);	
$dddd="<table><tr><td><a href=?action=newticket><img border=0 src=$sitemainurl/images/newticket.gif></a></td></tr></table>";
$dddd.=$viewticketsvar;
echo $dddd;
}
	
	break;
	case "newticket":
$regtemplatefile="newticketform.html";
$arrayofregform=array(
"[temp_form_action]" => "?action=savenewticket",
"[temp_form_ticket_subject_value]" => "",
"[temp_form_ticket_text_value]" => ""
);

$gg=$forms->form($sitemainpath,$_SESSION[site_style],$regtemplatefile,$arrayofregform);
$gg=$language->language($sitemainpath,$gg,$_SESSION[site_lang]);
echo $gg;	
	break;
    case "reply":
$reptemplatefile="replyticketform.html";
$arrayofrepform=array(
"[temp_form_action]" => "?action=savereplyticket&tid=$_GET[tid]",
"[temp_form_ticket_subject_value]" => "",
"[temp_form_ticket_text_value]" => "",
);

$hh=$forms->form($sitemainpath,$_SESSION[site_style],$reptemplatefile,$arrayofrepform);
$hh=$language->language($sitemainpath,$hh,$_SESSION[site_lang]);
echo $hh;
   break;

case "savenewticket":
$sqlofnewticket="INSERT INTO `tickets` ( `id` , `tid` , `u_name` , `date` , `subject` , `txt` )
VALUES ('', '0', '$_SESSION[member_name]', '$datess', '$_POST[ticket_subject]', '$_POST[ticket_text]');";
$resultofnewticket=mysql_query($sqlofnewticket);
if ($resultofnewticket==1) {
echo " „ Õ›Ÿ «·»ÿ«ﬁ… »‰Ã«Õ";	
echo "<meta http-equiv=Refresh content=2;URL=?action=>";
}else {
echo "·„ Ì „ Õ›Ÿ «·»ÿ«ﬁ… »‰Ã«Õ";
}
break;
case "savereplyticket":
$sqlofreplyticket="INSERT INTO `tickets` ( `id` , `tid` , `u_name` , `date` , `subject` , `txt` )
VALUES ('', '$_GET[tid]', '$_SESSION[member_name]', '$datess', '$_POST[ticket_subject]', '$_POST[ticket_text]');";
$resultofreplyticket=mysql_query($sqlofreplyticket);
if ($resultofreplyticket==1) {
echo " „ Õ›Ÿ «·»ÿ«ﬁ… »‰Ã«Õ";	
echo "<meta http-equiv=Refresh content=2;URL=?action=>";
}else {
echo "·„ Ì „ Õ›Ÿ «·»ÿ«ﬁ… »‰Ã«Õ";
}
break;

case "view":
$sqlofviewreplaytickets="SELECT * FROM `tickets` WHERE `tid` = '$_GET[tid]'";
$resultofviewreplayticket=mysql_query($sqlofviewreplaytickets);
$sqlofviewmainticket="SELECT * FROM `tickets` WHERE `id` = '$_GET[tid]' && `tid` = '0'";
$resultofviewmainticket=mysql_query($sqlofviewmainticket);
$rowofviewmainticket=mysql_fetch_array($resultofviewmainticket);
$filenameofviewmainticket="viewtickets.html";
$arrayofviewmainticket=array(
"[temp_ticket_subject_value]" => "$rowofviewmainticket[subject]",
"[temp_ticket_text_value]" => "$rowofviewmainticket[txt]",
"[temp_ticket_view_url]" => "",
"[temp_date_of_ticket]" => "$rowofviewmainticket[date]"
);
$viewticketvar=$forms->form($sitemainpath,$_SESSION[site_style],$filenameofviewmainticket,$arrayofviewmainticket);
$viewticketvar=$language->language($sitemainpath,$viewticketvar,$_SESSION[site_lang]);
echo $viewticketvar;
$filenameofviewreplaytickets="viewreplaytickets.html";
while ($rowofviewreplaytickets=mysql_fetch_array($resultofviewreplayticket)) {
	$arrayofviewreplayticket=array(
"[temp_ticket_subject_value]" => "$rowofviewreplaytickets[subject]",
"[temp_ticket_text_value]" => "$rowofviewreplaytickets[txt]",
"[temp_ticket_view_url]" => "",
"[temp_date_of_ticket]" => "$rowofviewreplaytickets[date]"
);
$viewreplayticketvar.=$forms->form($sitemainpath,$_SESSION[site_style],$filenameofviewreplaytickets,$arrayofviewreplayticket);
}
$viewreplayticketvar=$language->language($sitemainpath,$viewreplayticketvar,$_SESSION[site_lang]);
$ssss="<table><tr><td><a href=?action=reply&tid=$_GET[tid]><img border=0 src=$sitemainurl/images/reply.gif></a></td></tr></table>";
$ssss.=$viewreplayticketvar;
echo $ssss;
break;
}



echo $footer;
?>
