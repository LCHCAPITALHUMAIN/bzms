<?php
include("header.php");

switch ($_GET[action])
{
case "addform":
$catsubbs=$forms->catsub();
$filepath="$sitemainpath/templates/$_SESSION[site_style]/cp/cataddform.html";
$lang="$sitemainpath/lang/$_SESSION[site_lang]";
$array=array(
"[form_action]" => "?action=addaccept",
"[page_title]" => "«÷«›… ﬁ”„ ÃœÌœ",
"[temp_cat_title_value]" => "",
"[subcat_subcat]" => "$catsubbs",
"[send]" => "«—”«·",
"[clear]" => " ›—Ì€ «·ÕﬁÊ·",
);
$me=$forms->cpanel($filepath,$lang,$array);
echo $me;
break;

case "addaccept":
$sql="INSERT INTO `services` ( `serv_id` , `serv_title` , `serv_sid` , `serv_item_num` )
VALUES ('', '$_POST[title]', '$_POST[sid]', '0');";
$sqlaql=$forms->makesql($sql);
echo "<center><b> „ «÷«›… «·Œœ„… «·ÃœÌœÂ";
break;

case "show":
$servselectquery=$serv->selectserv();
if (mysql_num_rows($servselectquery)==0) {
	
}else {
$htmlll="<center><table border=1 dir=rtl width=100%><tr><td>⁄‰Ê«‰ «·Œœ„…</td><td>⁄œœ «·„‰ Ã«  „‰ Â–« «·‰Ê⁄</td><td>Œ’«∆’</td></tr>";
while ($rowofserv=mysql_fetch_array($servselectquery)) {
$htmlll.="<tr><td><a href=?action=view&servid=$rowofserv[serv_id]>$rowofserv[serv_title]</a></td><td>$rowofserv[serv_sid]</td><td>Edit / Delete</td></tr>";
$htmlll=str_replace("Edit","<a href=?action=edit&id=$rowofserv[serv_id]>Edit</a>","$htmlll");
$htmlll=str_replace("Delete","<a href=?action=delete&id=$rowofserv[serv_id]>Delete</a>","$htmlll");
}
$htmlll.="</table>";
}
echo "$htmlll";

break;
case "view":
if(!isset($_GET[servid]))
{
	echo"<center><b>You Didn't Select Any Service";
}else{
$checksubs=$serv->checksub($_GET[servid]);
if($checksubs==0)
{

}else {
$httt.="<center><table border=1 dir=rtl width=100%><tr><td>⁄‰Ê«‰ «·Œœ„…</td><td>⁄œœ «·„‰ Ã«  „‰ Â–« «·‰Ê⁄</td><td>Œ’«∆’</td></tr>";
while ($rowofsubserv=mysql_fetch_array($checksubs)) {
$httt.="<tr><td><a href=?action=view&servid=$rowofsubserv[serv_id]>$rowofsubserv[serv_title]</a></td><td>$rowofsubserv[serv_sid]</td><td>Edit / Delete</td></tr>";
$httt=str_replace("Edit","<a href=?action=edit&id=$rowofsubserv[serv_id]>Edit</a>","$httt");
$httt=str_replace("Delete","<a href=?action=delete&id=$rowofsubserv[serv_id]>Delete</a>","$httt");
}
echo "$httt";

}
}

$elements=$serv->adminelementsview($_GET[servid]);
if($elements==0)
{
echo "<center><b>·«ÌÊÃœ „‰ Ã«  »Â–« «·ﬁ”„";
}else{
echo"<center><table border=1 dir=rtl width=100%><tr><td>’Ê—… «·„‰ Ã</td><td>«”„ «·„‰ Ã</td></tr>";
while ($rowofelements=mysql_fetch_array($elements)) {
	echo"<tr>
	<td><img src=$sitemainurl/images/productimg/$rowofelements[pro_img] width=100 hight=70>
	
	<td>
	<a href=products.php?action=edit&proid=$rowofelements[pro_id]>$rowofelements[pro_title]</a>
	</td>
	</tr>
	
	
	
	
	";
}
}
echo "</table>";

break;
case "edit":
$sqlofedit="SELECT * FROM `services` where `serv_id`='$_GET[id]'";
$queryofedit=mysql_query($sqlofedit);
if (mysql_num_rows($queryofedit)!==1) {
	die("The Service You Need Is Not Found");
}
$rowofedit=mysql_fetch_array($queryofedit);
$catsubbs=$forms->editcatsub($rowofedit[serv_sid]);
$filepaths="$sitemainpath/templates/$_SESSION[site_style]/cp/cataddform.html";
$langs="$sitemainpath/lang/$_SESSION[site_lang]";
$array2=array(
"[form_action]" => "?action=update&id=$rowofedit[serv_id]",
"[page_title]" => " ÕœÌÀ «·»Ì«‰« ",
"[temp_cat_title_value]" => "$rowofedit[serv_title]",
"[subcat_subcat]" => "$catsubbs",
"[send]" => "«—”«·",
"[clear]" => " ›—Ì€ «·ÕﬁÊ·",
);
$mes=$forms->cpanel($filepaths,$langs,$array2);
echo $mes;
break;
case "update":
$updatequery="UPDATE `services` SET `serv_title` = '$_POST[title]',
`serv_sid` = '$_POST[sid]' WHERE `serv_id` = '$_GET[id]';";
mysql_query($updatequery);
break;
case "delete":
if (!isset($_GET[id])) {
	echo "„‘  —ÊÕ  Œ «—·ﬂ „‰ Ã «·«Ê·";
}else {
$sqlofdel="SELECT * FROM `services` where `serv_id`='$_GET[id]'";
$queryofdel=mysql_query($sqlofdel);
if (mysql_num_rows($queryofdel)!==1) {
	die("The Service You Need Is Not Found");
}else {
	$rowofdel=mysql_fetch_array($queryofdel);
if ($rowofdel[serv_item_num]>0) {
		die("You Can't Delete This Services Because It's Have An Products In It");
}else {	
$delsql="DELETE FROM `services` WHERE `serv_id` = '$_GET[id]'";
$delquery=forms::makesql($delsql);
if ($delquery==0) {
	echo "·„ Ì „ Õ–› «·Œœ„… »‰Ã«Õ";
}else {
 echo " „ «·Õ–› »‰Ã«Õ";
}}}}
break;
}
echo $footer;
?>
