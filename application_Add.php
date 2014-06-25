<?php
 $uname;
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

if(isset($_POST['fillsubmit']))
{
if(!empty($_POST['refid']))
{
require_once("connect.php");
	$rid=$_POST['refid'];
	$query3="Select * from contact where id='$rid' and user='$uname'";
	$res=mysql_query($query3);
	if($row3=mysql_fetch_array($res))
	{
	$editid=$row3[0];
	}
	else{
	$message3="You have enterd invalid refernce Id";
	}
}
else
$message3="Referece Id can not be left blank";

}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact book</title>
<link href="css/app.css" rel="stylesheet" type="text/css" />
<link href="css/application.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--

-->
</style>

<script type="text/javascript">

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
				      if(temp=="Succesfully updated")
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

var refid=document.getElementById("refid").value;
 document.getElementById("status").innerHTML="Please wait.......";
txt='email='+em+'&refid='+refid+'&user='+un+'&lname='+ln+'&cat='+cat+'&mobile='+mobile+'&h_phone='+h_phone+'&country='+country+'&web='+web+'&job='+job+'&city='+city+'&fax='+fax+'&company='+company+'&address='+address+'&mname='+mname+'&fname='+fname+'&bus_phone='+bus_phone+'&note='+note+'&b_address='+b_address;


useajax("select2.php",txt,"status");


}

function deletecon(){
var refid=document.getElementById("refid").value;
var txt='refid='+refid;
useajax("delete.php",txt,"status");
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
      <td><div align="center"><a href="application_Edit.php"><img src="images/addressbook-add-icon.png" alt="add contacts" width="64" height="64" /></a><br />
      Add Contacts </div></td>
      <td><div align="center"><a href="application_Add.php"><img src="images/addressbook-edit-icon.png" alt="edit Contact" width="64" height="64" /></a><br />
      Edite Contacts</div></td>
    </tr>
    <tr>
      <td colspan="3">	<hr>
     <div id="getid"><form action="" method="post" name="fill" id="fill" >
         
        
        
       <table width="800" border="0">
         <tr>
           <td width="152"><div align="right">Reference ID : </div></td>
           <td width="165"><input type="text" id="refid" name="refid" 
           value="<?php
                    if(isset($row3[0]))
					echo "$row3[0]";
					else
					echo "";
					
					?>"
           /></td>
           <td width="134"><input type="submit" name="fillsubmit" class="btn" value="submit"/></td>
           <td width="331"><div id="status"><?php
           if(isset($message3))
		   echo $message3;
		   ?>
           </div></td>
         </tr>
         <tr>
           <td colspan="4"><div align="center" class="style15"><span class="style14">*First enter the Reference id which belogs to the  record that you are going to edit or delete&nbsp;&nbsp;&nbsp;(Reference ID  can be found in contact list)</span></div></td>
           </tr>
       </table>
       </form>
        </div>
        
      
      <form action="select2.php" method="post" id="addcon" onsubmit="inputdata();return false;">
    <div>
    
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
                    
                    </select>  Or <input name="txtcat" type="text" id="txtcat" size="15" /></td>
                   </tr>
                  <tr>
                    <td width="97"><div align="right">First Name : </div></td>
                    <td width="270"><input type="text" name="fname" id="fname" 
                    value="<?php
                    if(isset($row3[1]))
					echo "$row3[1]";
					else
					echo "";
					
					?>"/> </td>
                    <td width="109"><div align="right">Last Name :</div></td>
                    <td width="306"><input type="text" name="lname" id="lname"
                     value="<?php
                    if(isset($row3[2]))
					echo "$row3[2]";
					else
					echo "";
					
					?>"
                    /> </td>
                  </tr>
                  <tr>
                    <td><div align="right">Telephone :</div></td>
                    <td><input type="text" name="home_phone" id="home_phone"
                     value="<?php
                    if(isset($row3[7]))
					echo "$row3[7]";
					else
					echo "";
					
					?>"
                    /> </td>
                    <td><div align="right">Mobile :</div></td>
                    <td><input type="text" name="mob_phone" id="mob_phone"
                     value="<?php
                    if(isset($row3[8]))
					echo "$row3[8]";
					else
					echo "";
					
					?>"
                    /> </td>
                  </tr>
                  <tr>
                    <td><div align="right">Address :</div></td>
                    <td colspan="3"><input name="h_address" type="text" id="h_address" size="60"
                     value="<?php
                    if(isset($row3[12]))
					echo "$row3[12]";
					else
					echo "";
					
					?>"
                    /> </td>
                    </tr>
                  <tr>
                    <td><div align="right">Email :</div></td>
                    <td colspan="3"><input name="email" type="text" id="email" size="60"
                     value="<?php
                    if(isset($row3[10]))
					echo "$row3[10]";
					else
					echo "";
					
					?>"
                    /> </td>
                    </tr>
                </table>
         
       </div>
      </div>
      
      <div>
     
       <div class="search">
       <div class="essent" id="optional1">
       Optional Information</div>
       <div id="optional">
       
        <table width="800" border="0">
          <tr>
            <td><div align="right">Middle Name :</div></td>
            <td><input type="text" name="mname" id="mname"
             value="<?php
                    if(isset($row3[2]))
					echo "$row3[2]";
					else
					echo "";
					
					?>"
            /></td>
            <td><div align="right">HomePage: </div></td>
            <td> &nbsp;http://www. 
              <input type="text" name="web" id="web"
               value="<?php
                    if(isset($row3[11]))
					echo "$row3[11]";
					else
					echo "";
					
					?>"
              /></td>
          </tr>
          <tr>
            <td width="118"><div align="right">Job Title : </div></td>
            <td width="248"><input type="text" name="job" id="job"
             value="<?php
                    if(isset($row3[4]))
					echo "$row3[4]";
					else
					echo "";
					
					?>"
            /> </td>
            <td width="118"><div align="right">Company :</div></td>
            <td width="298"><input type="text" name="company" id="company"
             value="<?php
                    if(isset($row3[5]))
					echo "$row3[5]";
					else
					echo "";
					
					?>"
            /> </td>
          </tr>
          <tr>
            <td><div align="right">Business Phone :</div></td>
            <td><input type="text" name="bus_phone" id="bus_phone"
             value="<?php
                    if(isset($row3[6]))
					echo "$row3[6]";
					else
					echo "";
					
					?>"
            /> </td>
            <td><div align="right">Fax : </div></td>
            <td><input type="text" name="fax" id="fax"
             value="<?php
                    if(isset($row3[9]))
					echo "$row3[9]";
					else
					echo "";
					
					?>"
            /> </td>
          </tr>
          <tr>
            <td><div align="right">City :</div></td>
            <td><input name="city" type="text" id="city" size="30"
             value="<?php
                    if(isset($row3[14]))
					echo "$row3[14]";
					else
					echo "";
					
					?>"
            /> </td>
            <td><div align="right">Country :</div></td>
            <td><input type="text" name="country" id="country"
             value="<?php
                    if(isset($row3[15]))
					echo "$row3[15]";
					else
					echo "";
					
					?>"
            /></td>
          </tr>
          <tr>
            <td><div align="right">Buisness Addres :</div></td>
            <td colspan="3"><input name="b_address" type="text" id="b_address" size="60"
             value="<?php
                    if(isset($row3[12]))
					echo "$row3[12]";
					else
					echo "";
					
					?>"
            /> </td>
            </tr>
          <tr>
            <td><div align="right">Note :</div></td>
            <td colspan="3"><textarea name="note" id="note"> <?php
                    if(isset($row3[16]))
					echo "$row3[16]";
					else
					echo "";
					
					?></textarea></td>
          </tr>
        </table>
        
         
          
          </div>
       </div>
      </div>
      <div><div id="status">&nbsp;
      </div>
    <div id="buttons">
    
      
         <input name="clear" type="reset" class="btn" id="clear" style="width:100px" value="Clear" />
    <input type="submit" name="save" id="save" value="Save"  class="btn"  style="width:100px" title ="Edit Contact" />
    
    </div>
    </div>
       </form>
   <form action="delete.php" method="post" onsubmit="deletecon();return false;">
    <input type="submit" id="delete"  name="delete" value="Delete" class="btn" style="width:100px" title ="Delete Contact" />
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
