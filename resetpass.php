<?php
if(isset($_COOKIE['so'])){
$m="You have succefully logout";
setcookie("so","",time()-3600,"/");
}
if(isset($_COOKIE['id']))
header("Location:index.php?id=".$_COOKIE['id']);
else{
if (isset($_POST['login'])){
$u=$_POST['uname'];
$p=$_POST['pass'];

	if(!empty($u) && !empty($p)){
	require("connect.php");
	$p=md5($p);
	$l=mysql_query("select id from registration where uname='$u' and pass='$p'") ;
	
		if($row=mysql_fetch_array($l)){
		setcookie("id",$row[0],0,"/");
		header("Location:index.php?id=$row[0]");
		mysql_free_result($l);
		}
		else{
		$m="Incorect username or password";
		
		}
	
	mysql_close($link);
	}
	else{
	
	$m="Insert user name and password to login";
	
	
	}

}

}
?>

<?php
if(isset($_POST['recover']))
{$mess;
	if(!empty($_POST['uname2']) && !empty($_POST['sq']) && !empty($_POST['ans2']) && !empty($_POST['email2']))
	{
	require("connect.php");
	$uname2=$_POST['uname2'];
	$sq2=$_POST['sq'];
	$ans2=$_POST['ans2'];
	$email2=$_POST['email2'];

	$result2=mysql_query("select id from registration where uname='$uname2' and sq='$sq2' and ans='$ans2' and  email='$email2'");
	if($row2=mysql_fetch_array($result2))
	{
	$temp=md5(uniqid(rand()));
	$message="Click on http://www.mycontacts.tharindu.aersokylive.com/project/recover?p=".$temp;
	$from="noreply@aeroskylive.com";
	$to=$email2;
	$headers = "From:" . $from;
	$subject = "Test mail";
	setcookie("repass",$temp,0,"/");
	//mail($to,$subject,$message,$headers);
	//mail function should be tested in real server.
	$query2="update registration set temp_pass='$temp' where uname='$uname2'";
	mysql_query($query2) or die("eroor:".mysql_error());
	if(mysql_affected_rows()>0){

	$mess="Confirmation email is sent to your email inbox.<br> click on the link given in that email";
	
	}
	else{
	$mess="Error occured while processing ! try again.";
	}
	

	}
	else{
	$mess="You have entered wrong information";
	}
	}
	else{
	$mess="Required fiels can not be left blank";
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact book</title>
<link href="css/default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
#logo{
color:#FFFFFF;
font-size: 42px;;
width:300px;
margin: 20px ;
float :left;
}
.style7 {font-size: 16px; color: #FF0000;}
#registe{
float:right;
	color:#3B5998;
	font-size:16px;
}

	.re input,option{
	height:20px;
	
	}
	.field{
	height:30px;
	}

-->
</style>

 



</head>

<body>

<div id="top1">
<div id="top">
  <div id='logo'><strong>
	<span class="style4">Contact Book	</span></strong></div>
    <div id="login">
    <form action="" method="post" id="flogin">
      <table width="433" border="0" align="right">
        <tr>
          <td width="165">User name </td>
          <td width="166">Password</td>
          <td width="88">&nbsp;</td>
        </tr>
        <tr>
          <td><input type="text" name="uname" > </td>
          <td><input type="password" name="pass"> </td>
          <td><input type="submit" name="login" value="Login" class="btn"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><a href="#"> Forgot your password? </a></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="23" colspan="3">
          <div align="left" style="color:#CCCC33;font-weight:bold;">					      					        <?php 
		  if(isset($m))
        echo $m;
      ?>			
      </div></td>
          </tr>
      </table>
      </form>
    </div>
  </div>
  
  </div>
  <div>
  <div id="conten">
  <div id="conimage" class="in">
  <br><br />
  <br />
  <img src="images/a10.jpg" width="475" height="370" /></div>
  
  <div id="registe" class="in">
  
   <br><br />
  <br /> 
  
  <H1>Password Reset <br />
  </H1>
  <hr align="left" width="400" />
  <form action="" method="post" id="com">
  
  <table width="450" border="0" cellpadding="2" cellspacing="5" >
    <tr>
      <td width="125" align="right">User Name :</td>
      <td width="271"><div class="re"><input name="uname2" type="text" size="30" maxlength="50" id="uname">
      </div></td>
    </tr>
    <tr>
      <td align="right">Email :</td>
      <td><div class="re"><input name="email2" type="text" size="30" maxlength="50" id="email">
      </div></td>
    </tr>
    <tr>
      <td align="right"> Security Question :</td>
      <td><div class="re">
      <select name="sq" class="fields2" id="sq">
<option value="" selected="selected">--Please Select--</option>
<option value="q1">What is my mom's maiden name?</option>
<option value="q2">What is my fist mobile number?</option>
<option value="q3">What is my pet's name?</option>
<option value="q4">How much is my first salary?</option>
<option value="">What is my school name ?</option>
<option value="">what is my A/L index number?</option>
<option value="">who is my favorite singer ?</option>
<option value="">who is my favorite cricketer ?</option>
<option value="">What is the name of my first son?</option>
<option value="">Who is my 1st teacher?</option>
<option value="">What is my profession ?</option>
</select>
      
      
      
      
      </div></td>
    </tr>
    <tr>
      <td align="right">Answer :</td>
      <td><div class="re">
      <input name="ans2" type="text" size="30" id="ans">
      
      
      
      </div></td>
    </tr>
    <tr>
      <td height="40" colspan="2" align="center"><input type="submit" name="recover" class="btn" value="Next">&nbsp;<input type="reset" name="reset2" class="btn" value="Reset"></td>
      </tr>
    <tr>
      <td height="59" colspan="2" class="style7" id="status"><?php if(isset($mess))
	   echo $mess;
	   ?></td>
      </tr>
  </table>
   <hr align="left" width="400" />
  </form>
  </div>
  </div>
 </div>
 <div id="bottom">
 <hr style="color:#FF0000"/>
 
 </div>
</body>
</html>
