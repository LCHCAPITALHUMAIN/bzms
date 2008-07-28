<?php
class lang
{
function language($sitemainpath,$con,$langs)
{
include("$sitemainpath/lang/$langs");
foreach ($lang as $key => $value) {
$con=str_replace("$key","$value","$con");
}
return $con;
}

}
?>
