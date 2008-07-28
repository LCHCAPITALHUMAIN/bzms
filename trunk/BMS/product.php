<?php
session_start();
include("include/all.php");
$mains->check($sitemainconf[site_style],$sitemainconf[site_lang]);
$head=$templates->header($sitemainconf[site_title],$sitemainpath,$_SESSION[site_style],$_SESSION[site_lang]);
echo $head;

switch ($_GET[action])
{
case "view":
if(!isset($_GET[proid]))
{
echo "<center><b>·„  ﬁ„ »√Œ Ì«— „‰ Ã";
}else{
$productselect=$product->productselect($_GET[proid]);

if($productselect==0)
{
echo"«·⁄‰’— «·–Ì ÿ·» Â €Ì— „ÊÃÊœ";

}else {
$productrow=mysql_fetch_array($productselect);
if (!$productrow[pro_permission]==1) {
echo "<br><b>«·⁄‰’— «·–Ì ÿ·» Â „ÊﬁÊ› «Ê ·„ Ì „  ›⁄Ì·Â »⁄œ";	
}else {
$productviewfilepath="product.html";
$productviewfilearray=array(
"[temp_product_title]" => "$productrow[pro_title]",
"[temp_product_ordered]" => "$productrow[pro_order_num]",
"[temp_product_view]" => "$productrow[pro_view_num]",
"[temp_product_date]" => "$productrow[pro_date]",
"[temp_product_img]" => "images/productimg/$productrow[pro_img]",
"[temp_product_text]" => "$productrow[pro_text]",
"[temp_product_price]" => "$productrow[pro_price]",
"[temp_product_id]" => "$productrow[pro_id]"
);
$producthtmltempreplace=$forms->form($sitemainpath,$_SESSION[site_style],$productviewfilepath,$productviewfilearray);
$producthtmltempreplace=$language->language($sitemainpath,$producthtmltempreplace,$_SESSION[site_lang]);
echo $producthtmltempreplace;
product::viewmore($_GET[proid]);
}
}}
break;
}


echo $footer;
?>