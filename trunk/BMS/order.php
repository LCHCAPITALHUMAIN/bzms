<?php
session_start();
include("include/all.php");
$mains->check($sitemainconf[site_style],$sitemainconf[site_lang]);
$head=$templates->header($sitemainconf[site_title],$sitemainpath,$_SESSION[site_style],$_SESSION[site_lang]);
echo $head;

switch ($_GET[action])
{
case"":

break;
case"sorder":
if(!isset($_GET[proid]))
{
echo "בד ÊÞד ÈÃÎÊםÇÑ דהÊÌ דÍÏÏ";
}else{
$proorderform="orderform.html";
$aarray=array(
"[temp_product_title]" => "$productrow[pro_title]",
"[temp_product_ordered]" => "$productrow[pro_order_num]"
);
$orderhtmltempreplace=$forms->form($sitemainpath,$_SESSION[site_style],$proorderform,$aarray);
$orderhtmltempreplace=$language->language($sitemainpath,$orderhtmltempreplace,$_SESSION[site_lang]);
echo $orderhtmltempreplace;
session_register("proid");
$_SESSION[proid]="$_GET[proid]";
}
break;
case "orderaccept":
if(!isset($_POST[order_pro_num])||!isset($_SESSION[proid]))
{
echo "בז ÓדÍÊ ÇÑÌÚ זÇÎÊÇÑ ÚהÕÑ זÍÏÏ ÚÏÏ ÇבÚהÇÕÑ Çבבם ÇהÊ דÍÊÇÌוÇ";
}elseif (!isset($_SESSION[member_name]))
{
	echo "בÇ םד‗ה‗ Úדב ØבÈ בדהÊÌ דÇ Ïזה Çה Ê‗זה דÓÌבÇ ÈÇבהÙÇד םד‗ה‗ ÇבÊÓÌםב דה ÎבÇב ÒÑ ÊÓÌםב ÈÇÚבם ÇבÕÝÍÉÇז ÇÐÇ ‗הÊ דÓÌבÇ דÓÈÞÇ Þד ÈÇבÏÎזב דה ÎבÇב ÒÑ ÏÎזב";
}else{
$selectyawad=$product->productselect($_SESSION[proid]);
$rowsofproduct=mysql_fetch_array($selectyawad);
$filename="orderaccept.html";
$totalprice=$_POST[order_pro_num]*$rowsofproduct[pro_price];
$acceptarray=array(
"[temp_product_img]" => "images/productimg/$rowsofproduct[pro_img]",
"[temp_product_title]" => "$rowsofproduct[pro_title]",
"[temp_order_pro_num]" => "$_POST[order_pro_num]",
"[temp_product_price]" => "$rowsofproduct[pro_price]",
"[temp_member_name]" => "$_SESSION[member_name]",
"[temp_order_total_price]" => "$totalprice"
);
$orderaccepthtmltempreplace=$forms->form($sitemainpath,$_SESSION[site_style],$filename,$acceptarray);
$orderaccepthtmltempreplace=$language->language($sitemainpath,$orderaccepthtmltempreplace,$_SESSION[site_lang]);
echo $orderaccepthtmltempreplace;
session_register("proid");
session_register("pronum");
session_register("totalprice");
session_register("proprice");

$_SESSION[proid]=$rowsofproduct[pro_id];
$_SESSION[pronum]=$_POST[order_pro_num];
$_SESSION[totalprice]=$totalprice;
$_SESSION[proprice]=$rowsofproduct[pro_price];

}
break;
case "save":
if(!isset($_SESSION[totalprice]))
{
echo "ÎØÃ";
}else {
$sqloforder="INSERT INTO `orders` ( `order_id` , `order_pro_id` , `order_pro_num` , `order_member_name` , `order_date` , `order_total_price` , `order_pro_price` , `order_status` )
VALUES (
'', '$_SESSION[proid]', '$_SESSION[pronum]', '$_SESSION[member_name]', '$datess', '$_SESSION[totalprice]', '$_SESSION[proprice]', '1');";
$qureyoo=mysql_query($sqloforder);
if(!$qureyoo==1)
{
echo "Insert Faild";
}else{
echo "Thanks The Order Is Now Saved And We Will Replied You Soon";
product::ordermore($_SESSION[proid]);
}
}
break;
}

echo $footer;
?>