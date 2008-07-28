<?php
class product
{
function productselect($id)
{
$sql="SELECT * FROM `product` where `pro_id` = '$id'";
$query=mysql_query($sql);
$nums=mysql_num_rows($query);
if($nums==0)
{
	return 0;
}else{
return $query;
}

}
function viewmore($id)
{
$selectcat="SELECT * FROM `product` where `pro_id`= '$id';";
$selectcatquery=mysql_query($selectcat);
$selectcatrow=mysql_fetch_array($selectcatquery);
$sss=$selectcatrow[pro_view_num]+1;
$sqlcat="UPDATE `product` SET `pro_view_num` = '$sss' WHERE `pro_id` = '$id';";
$queryofsqlcat=mysql_query($sqlcat);
	
}

function ordermore($id)
{
$selectcat="SELECT * FROM `product` where `pro_id`= '$id';";
$selectcatquery=mysql_query($selectcat);
$selectcatrow=mysql_fetch_array($selectcatquery);
$sss=$selectcatrow[pro_order_num]+1;
$sqlcat="UPDATE `product` SET `pro_order_num` = '$sss' WHERE `pro_id` = '$id';";
$queryofsqlcat=mysql_query($sqlcat);
}

}
?>