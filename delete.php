<?php

if(isset($_POST['refid']))
{$rid=$_POST['refid'];
require_once("connect.php");
$query4="delete from contact where id='$rid'";
mysql_query($query4) or die(mysql_error());
if(mysql_affected_rows()>0){
$message5="Succssfully deleted record RId = '$rid'";

unset($rid);
}
else
$message5="You have enterd invalid refernece id ";

}
else{
$message5="Refernce id shold be submited first";
}
echo $message5;
?>