<?php
session_start();
include("include/all.php");
$mains->check($sitemainconf[site_style],$sitemainconf[site_lang]);
$head=$templates->header($sitemainconf[site_title],$sitemainpath,$_SESSION[site_style],$_SESSION[site_lang]);
echo $head;

switch ($_GET[action])
{
case "":
$servselectquery=$serv->selectserv();
echo"<center><table dir=rtl><tr>";
	$tddd=0;
while ($rowofserv=mysql_fetch_array($servselectquery)) {
ECHO "<td><a href=?action=view&servid=$rowofserv[serv_id]>$rowofserv[serv_title]</a></td>";
$tddd++;
if($tablesTd == "4"){
echo "</TR>";
$tddd = 0;
}

}
echo "</table>";
break;
////////////////////////Break Of None Case///////////////////////////////////////
case "view":
if(!isset($_GET[servid]))
{
	echo"<center><b>You Didn't Select Any Service";
}else{
$checksubs=$serv->checksub($_GET[servid]);
if($checksubs==0)
{

}else {
echo"<center><table>";
while ($rowofsubserv=mysql_fetch_array($checksubs)) {
	echo"<tr><td><a href=?action=view&servid=$rowofsubserv[serv_id]>$rowofsubserv[serv_title]</a></td></tr>";
}
echo "</table>";
}
}

$elements=$serv->elementsview($_GET[servid]);
if($elements==0)
{
	
echo "·« ÌÊÃœ „‰ Ã«  »Â–« «·ﬁ”„";
}else{
echo"<center><table><tr><td></td><td></td></tr>";
while ($rowofelements=mysql_fetch_array($elements)) {
	echo"<tr>
	<td><img src=$sitemainurl/images/productimg/$rowofelements[pro_img] width=50 hight=50>
	
	<td>
	<a href=product.php?action=view&proid=$rowofelements[pro_id]>$rowofelements[pro_title]</a>
	</td>
	</tr>
	
	
	
	
	";
}
echo "</table>";
}


break;
////////////////////////Break Of None Case///////////////////////////////////////

}


echo $footer;
?>