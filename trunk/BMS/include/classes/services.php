<?php
class services
{
function selectserv()
{
$sql="SELECT * FROM `services` WHERE `serv_sid`='0'";
$query=mysql_query($sql);
return $query;
}	
//////////////////////////////////////////////////////////
function checksub($id){
$sql="SELECT * FROM `services` WHERE `serv_sid`='$id'";
$query=mysql_query($sql);
$nums=mysql_num_rows($query);
if($nums==0)
{
	return 0;
}else{
return $query;
}
}
/////////////////////////////////////////////////////////
function elementsview($id)
{
$sql="SELECT * FROM `product` WHERE `pro_sid`= '$id'&&`pro_permission`='1'";
$query=mysql_query($sql);
$nums=mysql_num_rows($query);
if($nums==0)
{
	return 0;
}else{
return $query;
}
}
///////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
function adminelementsview($id)
{
$sql="SELECT * FROM `product` WHERE `pro_sid`= '$id'";
$query=mysql_query($sql);
$nums=mysql_num_rows($query);
if($nums==0)
{
	return 0;
}else{
return $query;
}
}
///////////////////////////////////////////////////////////
}

?>