<?php

class members
{
function checkpermission($permissionid)
{
if(session_is_registered(member_name))
{
$result=mysql_query("SELECT * FROM `members` where `m_uname` = '$_SESSION[member_name]'");
if(mysql_num_rows($result)!=1)
{
 die("You Must Login First Before You Login Here <a href=$sitemainurl/login.php?action=loginform>Login</a>");
}else{
$row=mysql_fetch_array($result);
if($row[m_perm]!=$permissionid&&$row[m_perm]<$permissionid)
{
    die("You Don't have The Permission To Login Here");
}
}}else{
 die("You Must Login First Before You Login Here <a href=$sitemainurl/login.php?action=loginform>Login</a>");
}
}
	function checkhere()
	{
if(session_is_registered(member_name))
{
return "1";
}else{
return "0";	
}
}
function checkmuch($membername)
{
$sql="select * from members where `m_uname`='$membername';";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
switch ($row[m_perm])
{
	case "1":
	$return =1;
	break;
	
	case "2":
	$return = 2;
	break;

	case "3":
	$return = 3;
	break;
}
return $return;
}
function checkorderstatus($orderid)
{
if ($orderid==1) {
 $status="[lang_order_status_1]";
}elseif ($orderid==2)
{
 $status="[lang_order_status_2]";
}
return $status;
}
}
?>
