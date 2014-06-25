// JavaScript Document


function inputdata(){


var fn=document.getElementById("fname").value;
var ln=document.getElementById("lname").value;
var un=document.getElementById("uname").value;
var bm=document.getElementById("month").value;
var bd=document.getElementById("day").value;
var by=document.getElementById("year").value;
var pa=document.getElementById("pass").value;
var sq=document.getElementById("sq").value;
var ans=document.getElementById("ans").value;
var country=document.getElementById("country").value;

var rp=document.getElementById("rpass").value;
var sx=document.getElementById("sex").value;
var em=document.getElementById("email").value;
 document.getElementById("status").innerHTML="Please wait.......";
txt='email='+em+'&uname='+un+'&lname='+ln+'&day='+bd+'&year='+by+'&month='+bm+'&country='+country+'&ans='+ans+'&rpass='+rp+'&sq='+sq+'&fname='+fn+'&sex='+sx+'&pass='+pa;


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
							
							  document.getElementById("status").innerHTML=xmlhttp.responseText;
							  document.getElementById("com").reset();
							  if(xmlhttp.responseText==""Succesfully registered")
							  windows.location="connect.php";
							  
						    }
						  }

xmlhttp.open("POST","register.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(txt);

}