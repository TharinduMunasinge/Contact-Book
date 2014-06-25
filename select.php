<?php
$query="";
$m="unworking";
if(isset($_POST['cat'])){
if(!empty($_POST['fe']))
{
		if(!empty($_POST['cat']) &&  !empty($_POST['un']) && !empty($_POST['fe']))
		{
			$user=$_POST['un'];
			$cat=$_POST['cat'];
			$fe=$_POST['fe'];
			$key=$_POST['key'];
			if($fe!="any" && $cat!="any")
				$query="select fname,lname,h_address,mob_phone,home_phone,email from contact where user = '$user' and category='$cat' and ".$fe." like '%$key%'";
			elseif($fe!="any")
				$query="select fname,lname,h_address,mob_phone,home_phone,email from contact where user='$user' and $fe like '%$key%'";
			elseif($cat!="any")
				$query="";
			else
				$query="";
		}
		else
		{
		$m="Requird fields can cannot be left blank to search1";
		}
}
else{	
	
		$user=$_POST['un'];
		$cat=$_POST['cat'];
		if($cat!="any")
		$query="select id,fname,lname,h_address,mob_phone,home_phone,email from contact where user='$user' and category='$cat'";
		else
		$query="select id,fname,lname,h_address,mob_phone,home_phone,email from contact where user='$user'";

	

}

}
if(!empty($query) && $query != "")
{
require("connect.php");
$result=mysql_query($query);
$txt="<table width=\"800\" border=1><tr align=\"center\" id=\"fline\"><td>Ref Id</td><td>First Name</td><td>Last Name</td><td>Address</td><td>Mobile</td><td>Land</td><td>Email</td></tr>";
while($row=mysql_fetch_array($result))
{
  $txt = "$txt<tr>";
  for($b=0;$b<7;$b++)
  {
  if($b=0)
  $txt = "$txt<td><a href=\"#\" id=\"rd\" onclick=\"displaycontact()\">$row[$b]</a></td>";
  else
  $txt = "$txt<td>row[$b]</td>";
  }
  $txt = "$txt</tr>";
}
$txt = "$txt</table>";
$m=$txt;

}

echo "$m";
?>