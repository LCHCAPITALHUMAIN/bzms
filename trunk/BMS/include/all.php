<?php
//Classes Files Including
//Mysql Class Including
include("classes/main.php");
//Language Class Including
include("classes/language.php");
//Members Class Including
include("classes/members.php");
//Templates Class Including
include("classes/templates.php");
//Forms Class Including
include("classes/forms.php");
//Services Class Including
include("classes/services.php");
//Product Class Including
include("classes/product.php");

//Main Files Including
include("config.php");
//Declaring
//Declaring Mysql Class
$mains=new main();
//Declaring Language Class
$language=new lang();
//Declaring Members Class
$members=new members();
//Declaring Templates Class
$templates=new template();
//Declaring Forms Class
$forms=new forms();
//Declaring Services Class
$serv=new services();
//Declaring Services Class
$product=new product();


//Main Functions
$datess=date("l dS of F Y h:i:s A");
$mysqllink=$mains->connction($mysql_host,$mysql_user,$mysql_pass,$mysql_databasename);
$sitemainconf=$mains->dbconfig();



$footer=$templates->footer($sitemainconf[site_footer],$sitemainpath,$_SESSION[site_style],$_SESSION[site_lang]);
?>
