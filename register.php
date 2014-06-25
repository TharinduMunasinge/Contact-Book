<?php
require("connect.php");
//$a="Select uname,pass from registration where (uname=\'".$uname."\' and pass = \'".$pass."\')";






if(!empty($_POST['day']) && !empty($_POST['month']) && !empty($_POST['year']) &&!empty($_POST['uname']) && !empty($_POST['lname']) && !empty($_POST['fname']) && !empty($_POST['pass']) && !empty($_POST['rpass']) && !empty($_POST['sq']) && !empty($_POST['ans']) && !empty($_POST['country']) && !empty($_POST['sex'])){
$uname=$_POST['uname'];
$lname=$_POST['lname'];
$fname=$_POST['fname'];
$pass=md5($_POST['pass']);
$rpass=md5($_POST['rpass']);
$sq=$_POST['sq'];
$ans=$_POST['ans'];
$email=$_POST['email'];
$country=$_POST['country'];
$sex=$_POST['sex'];
$temp=md5(uniqid(rand()));
$day=$_POST['day'];
$year=$_POST['year'];
$month=$_POST['month'];

if($pass!==$rpass){
$m="Re tyeped password is wrong";
}
else
{
if (preg_match("/^[-0-9a-z]+(\.[0-9a-z-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.[a-z]{2,4}$/",$email)){
$l=mysql_query("select uname from registration where uname='$uname'") ;
if($r=mysql_fetch_array($l)){$m ="user name is already exist";}
else{

$l=mysql_query("select uname from registration where pass='$pass'") ;
if($r=mysql_fetch_array($l)){$m ="password is already exist";}

else{
$insert=mysql_query("Insert into registration values('','$uname','$pass','$fname','','$lname','$email','$country','$sex','$year','$month','$day','$sq','$ans','','','','','','')") or die("couln't enter any records!".mysql_error());

if(mysql_affected_rows()>0){

$m="Succesfully registered";
	
}
}
}




}
else{
$m="Invalid Email address";

}
}


}
else{
$m="Required fiels cannot be left blank";

}


echo $m;
?>