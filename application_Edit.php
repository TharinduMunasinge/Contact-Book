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
 $option="";
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
.essent
{
	background-color:#CCCCCC;
	font-size:14px;
	padding:10px;
border:solid 1px #333333;
}
.search{
	background-color:#FFFFCC;
	font-size:12px;
	border:solid 1px #333333;;
	margin:10px;
	}
#optional{
display:none;
}
.style11 {font-size: 10px}
#buttons{
float:right;
}
.style13 {font-size: 11px}

	#status{
	margin:10px;
	color:#FF0000;
	}

-->
</style>

<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
$("#optional1").click(function(){
    $("#optional").slideToggle("slow");
  });
});


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
				       if(temp=="Succesfully added")
					  document.getElementById("addcon").reset();

						    }
						  }

xmlhttp.open("POST",act,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(txt1);

}

function inputdata(){
var fname=document.getElementById("fname").value;
var ln=document.getElementById("lname").value;
var mname=document.getElementById("mname").value;
var un=document.getElementById("u").innerHTML;
var address=document.getElementById("h_address").value;
var b_address=document.getElementById("b_address").value;
var h_phone=document.getElementById("home_phone").value;
var bus_phone=document.getElementById("bus_phone").value;
var note=document.getElementById("note").value;
var cat1=document.getElementById("cat").value;
var cat2=document.getElementById("txtcat").value;
var country=document.getElementById("country").value;
var fax=document.getElementById("fax").value;
var note=document.getElementById("note").value;
var web=document.getElementById("web").value;
var company=document.getElementById("company").value;
var mobile=document.getElementById("mob_phone").value;
var em=document.getElementById("email").value;
var job=document.getElementById("job").value;
var city=document.getElementById("city").value;


var cat;
if((cat2=="" || cat2==null ) && cat1!=="Undefine")
cat=cat1;
else if(cat2=="" || cat2==null )
cat="";
else
cat=cat2;

 document.getElementById("status").innerHTML="Please wait.......";
txt='email='+em+'&user='+un+'&lname='+ln+'&cat='+cat+'&mobile='+mobile+'&h_phone='+h_phone+'&country='+country+'&web='+web+'&job='+job+'&city='+city+'&fax='+fax+'&company='+company+'&address='+address+'&mname='+mname+'&fname='+fname+'&bus_phone='+bus_phone+'&note='+note+'&b_address='+b_address;

result=useajax("insert.php",txt,"status");


}
</script>



</head>

<body>

<div id="top1">
  <div id="top">
  	<div id='logo'><strong>
	<span class="style4"> Contact Book	</span></strong>
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
      <td><div align="center"><a href="application.php"><img src="images/addressbook-search-icon.png" width="64" height="64" /></a>
      
      <br />
      Contact list</div></td>
      <td><div align="center"><a href="#"><img src="images/addressbook-add-icon.png" alt="add contacts" width="64" height="64" /></a><br />
      Add Contacts </div></td>
      <td><div align="center"><a href="application_Add.php"><img src="images/addressbook-edit-icon.png" alt="edit Contact" width="64" height="64" /></a><br />
      Edite Contacts</div></td>
    </tr>
    <tr>
      <td colspan="3">
      <form action="insert.php" method="post" id="addcon" onsubmit="inputdata();return false;">
    <div>
    	<hr>
      	 <div class="search">
         
     		  <div class="essent">
     		  Essential Information      		    </div>
      			 
                <table width="800" border="0">
                
                  <tr>
                    <td><div align="right">Category :</div></td>
                    <td colspan="3"><select name="cat" id="cat">
                      <?php
                    if(isset($option))
                    echo $option;
                    ?>
                    
                    </select>  Or <input name="txtcat" type="text" id="txtcat" size="15"/> 
&nbsp;                    (if categorys are undefined or  to create a new category  use text field)</td>
                   </tr>
                  <tr>
                    <td width="97"><div align="right">First Name : </div></td>
                    <td width="270"><input type="text" name="fname" id="fname"/> </td>
                    <td width="109"><div align="right">Last Name :</div></td>
                    <td width="306"><input type="text" name="lname" id="lname"/> </td>
                  </tr>
                  <tr>
                    <td><div align="right">Telephone :</div></td>
                    <td><input type="text" name="home_phone" id="home_phone"/> </td>
                    <td><div align="right">Mobile :</div></td>
                    <td><input type="text" name="mob_phone" id="mob_phone"/> </td>
                  </tr>
                  <tr>
                    <td><div align="right">Address :</div></td>
                    <td colspan="3"><input name="h_address" type="text" id="h_address" size="60"/> </td>
                    </tr>
                  <tr>
                    <td><div align="right">Email :</div></td>
                    <td colspan="3"><input name="email" type="text" id="email" size="60"/> </td>
                    </tr>
                </table>
         
       </div>
      </div>
      
      <div>
     
       <div class="search">
       <div class="essent" id="optional1">
       Optional Information
         <span class="style11">(Click to show or hide)</span></div>
       <div id="optional">
       
        <table width="800" border="0">
          <tr>
            <td><div align="right">Middle Name :</div></td>
            <td><input type="text" name="mname" id="mname"/></td>
            <td><div align="right">HomePage: </div></td>
            <td> &nbsp;http://www. 
              <input type="text" name="web" id="web"/></td>
          </tr>
          <tr>
            <td width="118"><div align="right">Job Title : </div></td>
            <td width="248"><input type="text" name="job" id="job"/> </td>
            <td width="118"><div align="right">Company :</div></td>
            <td width="298"><input type="text" name="company" id="company"/> </td>
          </tr>
          <tr>
            <td><div align="right">Business Phone :</div></td>
            <td><input type="text" name="bus_phone" id="bus_phone"/> </td>
            <td><div align="right">Fax : </div></td>
            <td><input type="text" name="fax" id="fax"/> </td>
          </tr>
          <tr>
            <td><div align="right">City :</div></td>
            <td><input name="city" type="text" id="city" size="30"/> </td>
            <td><div align="right">Country :</div></td>
            <td><input type="text" name="country" id="country"/></td>
          </tr>
          <tr>
            <td><div align="right">Buisness Addres :</div></td>
            <td colspan="3"><input name="b_address" type="text" id="b_address" size="60"/> </td>
            </tr>
          <tr>
            <td><div align="right">Note :</div></td>
            <td colspan="3"><textarea name="note" id="note"></textarea></td>
          </tr>
        </table>
        
         
          
          </div>
       </div>
      </div>
      <div><div id="status">&nbsp;
      </div>
    <div id="buttons">
         <input type="reset" id="resetf" value="clear" class="btn" style="width:100px" />
    <input type="submit" name="addcon" id="addcon" value="Add Contact"  class="btn"  style="width:100px"/>
    
    </div>
    </div>
       </form>
   
      </td>
    </tr>
  </table>

  </div>
  
</div>
  


<div id="bottom">
 <hr style="color:#FF0000"/>
 
 </div>
</body>
</html>
