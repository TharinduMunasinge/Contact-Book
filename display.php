<?php

if(!isset($_COOKIE['id']))
{
header("Location:index.php");
}
else{
if(isset($_GET['refid']) && isset($_GET['user'])  )
{

require_once("connect.php");

	$rid=$_GET['refid'];
	$uname=$_GET['user'];
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
{
//header("Location:index.php");
}
}
?>

<html>
<head>
<link href="css/application.css" rel="stylesheet" type="text/css" />
<link href="css/app.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	margin: 0px;
	padding: 0px;
	width : 100%;
	
	//background-color: #3B5998;
font-family: "lucida grande",tahoma,verdana,arial,sans-serif;
	//font: -webkit-small-control;
	overflow-y: scroll;
	font-size:12px;
}
.style17 {color: #000000; }
.style18 {color: #0000FF}
.style19 {color: #333333}
</style>
</head>
<body style="background-color:#3B5998">
  <div id="top1" style="height:350px;font-size:12px;color:#000000;width:600px;margin:auto">
    <div style="width:600px;font-size:12px;">
    
      	 <div class="search">
         
     		  <div class="essent" style="background-color:#99CC66;">
     		  Essential Information      		    </div>
      			 
                <table width="600" border="0" style="width:600px;font-size:12px">
                
                  <tr>
                    <td><div align="right" class="style17">Category :</div></td>
                    <td colspan="3"><span class="style18">
                    <?php
                    if(isset($row3[18]))
					{
					if(!empty($row3[18]))echo "$row3[18]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
                    </span>                    </td>
                  </tr>
                  <tr>
                    <td width="106"><div align="right" class="style17">First Name : </div></td>
                    <td width="174"><span class="style18">
                    <?php
                    if(isset($row3[1]))
						{
					if(!empty($row3[1]))echo "$row3[1]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
                    </span> </td>
                    <td width="66"><div align="right" class="style17">Last Name :</div></td>
                    <td width="236"><span class="style18">
                    <?php
                    if(isset($row3[2]))
						{
					if(!empty($row3[2]))echo "$row3[2]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
                    </span> </td>
                  </tr>
                  <tr>
                    <td><div align="right" class="style17">Telephone :</div></td>
                    <td><span class="style18">
                    <?php
                    if(isset($row3[7]))
						{
					if(!empty($row3[7]))echo "$row3[7]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
                    </span> </td>
                    <td><div align="right" class="style17">Mobile :</div></td>
                    <td><span class="style18">
                    <?php
                    if(isset($row3[8]))
						{
					if(!empty($row3[8]))echo "$row3[8]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
                    </span></td>
                  </tr>
                  <tr>
                    <td><div align="right" class="style17">Address :</div></td>
                    <td colspan="3"><span class="style17 style18">
                    <?php
                    if(isset($row3[12]))
						{
					if(!empty($row3[12]))echo "$row3[12]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					
					?>
                    </span> </td>
                  </tr>
                  <tr>
                    <td><div align="right" class="style17">Email :</div></td>
                    <td colspan="3"><span class="style17 style18">
                    <?php
                    if(isset($row3[10]))
					{
					if(!empty($row3[10]))echo "$row3[10]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
                    </span> </td>
                  </tr>
           </table>
         
      </div>
      </div>
      
      <div style="width:600px;margin:auto;">
     
       <div class="search">
       <div class="essent" id="optional1"  style="background-color:#99CC66;">
       Optional Information</div>
       <div id="optional">
       
        <table width=600" border="0" style="width:600px;font-size:12px">
          <tr>
            <td><div align="right" class="style17">Middle Name :</div></td>
            <td><span class="style18">
              <?php
                    if(isset($row3[2]))
					{
					if(!empty($row3[2]))echo "$row3[2]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
            </span></td>
            <td><div align="right" class="style17">HomePage: </div></td>
            <td> <span class="style18"><span class="style19">&nbsp;http://www.</span>
              <?php
                    if(isset($row3[11]))
					{
					if(!empty($row3[11]))echo "$row3[11]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
            </span></td>
          </tr>
          <tr>
            <td width="107"><div align="right" class="style17">Job Title : </div></td>
            <td width="173"><span class="style18">
              <?php
                    if(isset($row3[4]))
					{
					if(!empty($row3[4]))echo "$row3[4]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
            </span></td>
            <td width="72"><div align="right" class="style17">Company :</div></td>
            <td width="230"><span class="style18">
              <?php
                    if(isset($row3[5]))
					{
					if(!empty($row3[5]))echo "$row3[5]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
            </span></td>
          </tr>
          <tr>
            <td><div align="right" class="style17">Business Phone :</div></td>
            <td><span class="style18">
              <?php
                    if(isset($row3[6]))
				{
					if(!empty($row3[6]))echo "$row3[6]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
            </span></td>
            <td><div align="right" class="style17">Fax : </div></td>
            <td><span class="style18">
              <?php
                    if(isset($row3[9]))
					{
					if(!empty($row3[9]))echo "$row3[9]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
            </span> </td>
          </tr>
          <tr>
            <td><div align="right" class="style17">City :</div></td>
            <td><span class="style18">
              <?php
                    if(isset($row3[14]))
					{
					if(!empty($row3[14]))echo "$row3[14]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
            </span></td>
            <td><div align="right" class="style17">Country :</div></td>
            <td><span class="style18">
              <?php
                    if(isset($row3[15]))
						{
					if(!empty($row3[15]))echo "$row3[15]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
            </span></td>
          </tr>
          <tr>
            <td><div align="right" class="style17">Buisness Addres :</div></td>
            <td colspan="3"><span class="style18">
              <?php
                    if(isset($row3[12]))
					{
					if(!empty($row3[12]))echo "$row3[12]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
            </span></td>
          </tr>
          <tr>
            <td height="69" ><div align="right" class="style17"  >Note :</div></td>
            <td colspan="3"><span class="style18">
              <?php
                    if(isset($row3[16]))
					{
					if(!empty($row3[16]))echo "$row3[16]";
					else 
					echo "n\\a";
					}
					else
					echo "n\\a";
					?>
            </span></td>
          </tr>
        </table>
        
         
          
         </div>
       </div>
      </div>
     
   </div>
    
   </body>
   </html>