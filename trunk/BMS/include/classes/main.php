<?php
class main
{
function connction($mysql_host,$mysql_user,$mysql_password,$mysql_databasename)
{
//Connect To Host By User & Pass
$link = mysql_connect($mysql_host,$mysql_user,$mysql_password);
if (!$link) {
    die('Not connected : ' . mysql_error());
}

//Select the current db
$db_selected = mysql_select_db($mysql_databasename, $link);
if (!$db_selected) {
    die ("Can\'t use  :$mysql_databasename " . mysql_error());
}

return $link;
//Connection Function End
}

function dbconfig()
	{
	$sql="SELECT * FROM `config` where `site_id`= 1";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
    session_register("mainlang");
    session_register("mainstyle");
    $_SESSION[site_lang]=$row[site_lang];
	$_SESSION[site_style]=$row[site_style];
    return $row;
	}
	
function check($style,$lang)
    {
if(!session_is_registered($_SESSION[main_lang]))
{
session_register("main_lang");
$_SESSION[main_lang]="$lang";
}
if(!session_is_registered($_SESSION[main_lang]))
{
session_register("site_style");
$_SESSION[site_style]="$style";
}
}
//Main Class End
}




?>
