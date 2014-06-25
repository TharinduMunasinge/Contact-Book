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
if(isset($_COOKIE['repass']) && isset($_GET['p']))
{
	if(!empty($_COOKIE['repass']) && !empty($_GET['p']) )
	{

		$c=$_COOKIE['repass'];
		$g=$_GET['p'];
		if($c==$g)
		{
		
		
		}
		else{
		setcookie("repass","",time()-3600,"/");
		header("Location:index.php");
		}
	}

	else{
	setcookie("repass","",time()-3600,"/");
	header("Location:index.php");
	}

}

elseif(isset($_COOKIE['rpass']))
{
setcookie("repass","",time()-3600,"/");
header("Location:index.php");
}
else{
header("Location:index.php");
}
?>
<?php
if(isset($_POST['recover']))
{
	if(!empty($_POST['pass2']) && !empty($_POST['rpass2']) )
	{
		$p1=md5($_POST['pass2']);
		$rp1=md5($_POST['rpass2']);
		if($p1==$rp1)
		{
			require("connect.php");
			$c2=$_COOKIE['repass'];
			$queryr="update registration set pass='$p1' , temp_pass='' where temp_pass='$c2'";
			
			mysql_query($queryr);
			
			if(mysql_affected_rows()>0)
			{
			setcookie("repass","",time()-3600,"/");
			$mess="Succesfully reset the password .";}
			else
			{
			$mess="Error occured try again!";
			}
			
		
		}
		else
		{
		$mess="Re-type password is incorect";
		}
	}
	else
	{
	$mess="Required feilds canot be left blank";
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
  
  <H1>Change Password<br />
  </H1>
  <hr align="left" width="400" />
  <form action="" method="post" id="com">
  
  <table width="450" border="0" cellpadding="2" cellspacing="5" >
    <tr>
      <td align="right">New Password :</td>
      <td><div class="reg">
        <input name="pass2" type="password" size="30" maxlength="50" id="pass" />
      </div></td>
    </tr>
    <tr>
      <td align="right">Retype  Password :</td>
      <td><div class="reg">
        <input name="rpass2" type="password" size="30" maxlength="50" id="rpass" />
      </div></td>
    </tr>
    
    <tr>
      <td width="396" height="40" colspan="2" align="center"><input type="submit" name="recover" class="btn" value="Change">&nbsp;<input type="reset" name="reset2" class="btn" value="Reset"></td>
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
