<?php
class forms
{
function form($mainpropath,$nowstyle,$filepath,$array)
{
$filename="$mainpropath/templates/$nowstyle/$filepath";
$handle = fopen($filename, "r");
$con = fread($handle, filesize($filename));
fclose($handle);

foreach ($array as $key => $value) {
$con=str_replace("$key","$value","$con");
}
return $con;
}

function cpanel($filename,$lang,$array)
{
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);

foreach ($array as $key => $value) {
 $contents=str_replace("$key","$value","$contents");
}
include("$lang");
foreach ($lang as $key1 => $value1) {
 $contents=str_replace("$key1","$value1","$contents");
}

return $contents;
}

function catsub ()
{
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Start Of Cat Sub Cat Selecter

      $sql="select * from services where serv_sid ='0'";
      $query=mysql_query($sql);
      while($row=mysql_fetch_array($query))
      {
$value.="<option value=$row[serv_id]>$row[serv_title]</option>";
     $sql1="select * from services where serv_sid='$row[serv_id]'";
      $query1=mysql_query($sql1);
      while($row1=mysql_fetch_array($query1))
      {
$value.="<option value=$row1[serv_id]>>>>>$row1[serv_title]</option>";
     $sql2="select * from services where serv_sid='$row1[serv_id]'";
      $query2=mysql_query($sql2);
      while($row2=mysql_fetch_array($query2))
      {
$value.="<option value=$row2[serv_id]>>>>>++++$row2[serv_title]</option>";
     $sql3="select * from services where serv_sid='$row2[serv_id]'";
      $query3=mysql_query($sql3);
      while($row3=mysql_fetch_array($query3))
      {
$value.="<option value=$row3[serv_id]>>>>>++++******$row3[serv_title]</option>";
      }
      }

   }
$value.="<option>++++++++++++++++++++++++++++++++++++++++++</option>";
  }

//End Of Cat Sub Cat Selecter
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
return $value;
}


function editcatsub ($sid)
{
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//Start Of Cat Sub Cat Selecter

      $sql="select * from services where serv_sid ='0'";
      $query=mysql_query($sql);
      while($row=mysql_fetch_array($query))
      {
      	if ($row[serv_id]==$sid) {
$value.="<option value=$row[serv_id] selected>$row[serv_title]</option>";
      	}else {
$value.="<option value=$row[serv_id]>$row[serv_title]</option>";}
     $sql1="select * from services where serv_sid='$row[serv_id]'";
      $query1=mysql_query($sql1);
      while($row1=mysql_fetch_array($query1))
      {
      	      if ($row1[serv_id]==$sid) {
$value.="<option value=$row1[serv_id] selected>>>>>$row1[serv_title]</option>";
      }else {
$value.="<option value=$row1[serv_id]>>>>>$row1[serv_title]</option>";}
     $sql2="select * from services where serv_sid='$row1[serv_id]'";
      $query2=mysql_query($sql2);
      while($row2=mysql_fetch_array($query2))
      {
      	if ($row2[serv_id]==$sid) {
$value.="<option value=$row2[serv_id] selected>>>>>++++$row2[serv_title]</option>";		
      	}else {
$value.="<option value=$row2[serv_id]>>>>>++++$row2[serv_title]</option>";}
     $sql3="select * from services where serv_sid='$row2[serv_id]'";
      $query3=mysql_query($sql3);
      while($row3=mysql_fetch_array($query3))
      {
       if ($row3[serv_id]==$sid) {
     $value.="<option value=$row3[serv_id] selected>>>>>++++******$row3[serv_title]</option>";  	
       }else {
$value.="<option value=$row3[serv_id]>>>>>++++******$row3[serv_title]</option>";}
      }
      }

   }
$value.="<option>++++++++++++++++++++++++++++++++++++++++++</option>";
  }

//End Of Cat Sub Cat Selecter
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
return $value;
}

function wysiwyg($mainpropath,$formname,$fieldname,$inputvalue)
{
//Check user's Browser
if(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE")){
	echo "<script language=JavaScript src='$mainpropath/include/scripts/editor.js'></script>";
}else{
	echo "<script language=JavaScript src='$mainpropath/include/scripts/moz/editor.js'></script>";
}
echo "<script>
function submitForm()
	{
	//STEP 4: Set the Hidden Form field with the edited content.
	document.forms.$formname.elements.$fieldname.value = oEdit1.getHTMLBody();
	
	//STEP 5: Submit the Form.
	document.forms.$formname.submit()
	}
</script>";
$aaa="<!-- STEP 2: Embed the Editor -->
	<script>
		var oEdit1 = new InnovaEditor('oEdit1')
	oEdit1.features=['FullScreen','Preview','Print','Search','SpellCheck',
			'Cut','Copy','Paste','PasteWord','PasteText','|','Undo','Redo','|',
			'ForeColor','BackColor','|','Bookmark','Hyperlink',
			'CustomTag','HTMLFullSource',
			'BRK','Numbering','Bullets','|','Indent','Outdent','LTR','RTL','|','Image','Flash','Media','|','InternalLink','CustomObject','|',
			'Table','Guidelines','Absolute','|','Characters','Line',
			'Form','Clean','ClearAll','BRK',
			'StyleAndFormatting','TextFormatting','ListFormatting','BoxFormatting',
			'ParagraphFormatting','CssText','Styles','|',
			'Paragraph','FontName','FontSize','|',
			'Bold','Italic',
			'Underline','Strikethrough','|','Superscript','Subscript','|',
			'JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'];
oEdit1.RENDER('$inputvalue');
	</script>
	<!-- STEP 3: Add a Hidden Form Field -->
	<input type='hidden' name='$fieldname' id='$fieldname'>";
return $aaa;
}

function productpermissions($id,$langarray)
{
$array=array("1" => "$langarray[show]","0" => "$langarray[hide]");
foreach ($array as $key => $value)
{
if ($id==$key) {	
$html.="<option value=$key selected>$value</option>";
}else {
$html.="<option value=$key>$value</option>";
}}

return $html;
}

function memberpermissionlist($id,$langarray)
{
$array=array("1" => "$langarray[member]","2" => "$langarray[customer]","3" => "$langarray[admin]");
foreach ($array as $key => $value)
{
if ($id==$key) {	
$html.="<option value=$key selected>$value</option>";
}else {
$html.="<option value=$key>$value</option>";
}}

return $html;
}

function makesql($sql)
{
$query=mysql_query($sql);
return $query;
}

function listofdir($sss,$type,$name)
{
if ($handle = opendir("$sss")) {
    while (false !== ($file = readdir($handle))) { 
    	if ($file=="Thumbs.db"||$file=="."||$file=="..") {
    	continue;	
    	}elseif (is_dir("$sss/$file")) {
    		if ($file==$name) {	
    	$dir.= "<option value=$file selected>$file</option>";
    	}else {$dir.= "<option value=$file>$file</option>";
    	}}elseif (is_file("$sss/$file")) {
           		if ($file==$name) {	
    	$files.= "<option value=$file selected>$file</option>";
    	}else {$files.= "<option value=$file>$file</option>";
    	}
    	}
    }
    if ($type=="files") {
return $files;    	
    }elseif ($type=="dirs")
return $dir;
}
}
}

?>
