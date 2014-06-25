<?php
if(!isset($_COOKIE['id']))
{
header("Location:index.php");
}
else{
require("connect.php");
$id=$_COOKIE['id'];
$query1="select uname,fname,lname from registration where id='$id'";
$result=mysql_query($query1);
if($row=mysql_fetch_array($result))
{
 $uname= $row[0];
 $hname=" ( ".$row[1]." ".$row[2]." ) ";
 $result2=mysql_query("select distinct category from contact where user='$uname'");
  $option ="";
  $i=1;
 while($row2=mysql_fetch_array($result2))
 { if($i==1)
 $option="<option value=\"any\">Any</option>";
 $i++;
 $option = $option."<option value=\"$row2[0]\">$row2[0]</option>";
 }
 if(empty($option) || $option=="")
 $option ="<option value=\"\">Undefine</option>";
 
}

}

if(isset($_POST['logout']))
{
setcookie("id","",time()-3600,"/");
setcookie("so",1,0,"/");
header("Location:index.php");
}
if(isset($_POST['contact']))
{
header("Location:index.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact book</title>
<link href="css/app.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
#logo{
color:#FFFFFF;
font-size: 35px;;
width:250px;
margin: 15px ;
float :left;
}
#err{
color:#FF0000;

}
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
#result{
color:#FF0000;
}
-->
</style>

 <script type="text/javascript">
function  changecategory(){
var cat=document.getElementById("cat").value;
	/*if(cat=="Undefine")
	{
		document.getElementById("err").innerHTML="You should add contacts and category to search";
		return false;
	}*/
var jsuser=document.getElementById("u").innerHTML;
var txt='cat='+cat+'&un='+jsuser+'&fe=&key=';
alert("change text - "+txt);



}
 
 function changetext(x){
 var cat=document.getElementById("cat").value;
	/*if(cat=="Undefine")
	{
		document.getElementById("err").innerHTML="You should add contacts and category to search";
		return false;
	}*/
var jsuser=document.getElementById("u").innerHTML;
var jsfeild=document.getElementById("feild").value;
var txt='cat='+cat+'&un='+jsuser+'&fe='+jsfeild+'&key='+x;

 
 
 }
function useajax(act, txt1, output){

var temp;


var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
						  {
						  if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
							temp=xmlhttp.responseText; 
						
					  		document.getElementById(output).innerHTML=temp;
				      
					 alert("ajax working");

						    }
						  }

xmlhttp.open("POST",act,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(txt1);

}
function inuputdata(){
var cat=document.getElementById("cat").value;
	/*if(cat=="Undefine")
	{
		document.getElementById("err").innerHTML="You should add contacts and category to search";
		return false;
	}*/
var jsuser=document.getElementById("u").innerHTML;
var txt='cat='+cat+'&un='+jsuser+'&fe=&key=';

useajax=("select.php",txt,"result");
}
 
function loading(){
var t= "cat=any+&un=Tharinud";
useajax=("select.php",t,"result");

}

function displaycontact(){
var user=document.getElementById("u").innerHTML;
var refid=document.getElementById("rd").innerHTML;
var url1="display.php?user="+user+"&refid="+refid;
window.open(url1,"_blank","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=620, height=420");

}

 </script>


</head>

<body onload="loading()">

<div id="top1">
  <div id="top">
  	<div id='logo'><strong>
	<span class="style4">Contact Book	</span></strong>
    </div>
    <div id="username">
    <?php echo "<a class=\"unames\" href=\"#\" title=\"User name\" id=\"u\">$uname</a>";
	echo "    <a class=\"unames\" href=\"#\" title=\"Human name\">$hname</a>";
	?>
    
    </div>
    <div id="login">
    <form action="" method="post">
    <input type="submit" class="btn" name="contact" value="Contacts" />
    <input type="submit" class="btn" name="Profile" value="Profile" />
    <input type="submit" class="btn" name="logout" value="Logout" />
    
    </form>
   
     </div>
  </div>
  
</div>
<div>
<div id="con">
  <table width="800" border="0" align="center">
    <tr id="first">
      <td><div align="center"><a href="#"><img src="images/addressbook-search-icon.png" width="64" height="64" /></a>
      
      <br />
      Contact list</div></td>
      <td><div align="center"><a href="application_Edit.php"><img src="images/addressbook-add-icon.png" alt="add contacts" width="64" height="64" /></a><br />
      Add Contacts </div></td>
      <td><div align="center"><a href="application_Add.php"><img src="images/addressbook-edit-icon.png" alt="edit Contact" width="64" height="64" /></a><br />
      Edite Contacts</div></td>
    </tr>
    <tr>
      <td colspan="3"><div><hr>
       <div id="search">
       <form action="select.php" method="post" name="sform" id="sform" onsubmit="inputdata();return false;">
        <table width="442" border="0" cellpadding="3" cellspacing="3">
          <tr>
            <td height="20" colspan="2"><strong>Search Contacts</strong></td>
            </tr>
          <tr>
            <td width="71"><div align="right">Category :</div></td>
            <td width="350"><select name="cat" id="cat" onchange="changecategory()">
            
            <?php
			if(isset($option))
			echo $option;
            ?>
            </select><span id="err">&nbsp;</span> </td>
            </tr>
          <tr>
            <td><div align="right">Feild :</div></td>
            <td><select name="feild" id="feild">
            <option value="any" selected="selected" id="">Any</option>
            <option value="fname">First Name</option>
            <option value="lname">Last Name</option>
            <option value="country">Country</option>
            <option value="job">Job title</option>
            <option value="mob_phone">Mobile</option>
            <option value="email">Email</option>
            <option value="mname">Middle Name</option>
            <option value="company">Company</option>
            <option value="h_address">Home Address</option>
             <option value="note">Note</option>
            </select> 
              contains 
              <input type="text" name="keyword" id="key" onkeyup="changetext(this.value)"/></td>
            </tr>
        </table></form>
       </div>
       <div id="result">
       a
       </div>
      </div></td>
    </tr>
  </table>
  </conten>
</div>
<div id="bottom">
 <hr style="color:#FF0000"/>
 
 </div>
</body>
</html>
