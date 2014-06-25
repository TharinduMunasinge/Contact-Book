<?

require("connect.php");
if(!empty($_POST['refid']) && !empty($_POST['cat']) && !empty($_POST['mobile']) && !empty($_POST['user']) && !empty($_POST['lname']) && !empty($_POST['fname']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['h_phone']))
{
$refid=$_POST['refid'];
$category = $_POST['cat'];
$mob_phone = $_POST['mobile'];
$home_phone = $_POST['h_phone'];
$bus_phone = $_POST['bus_phone'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$user = $_POST['user'];
$lname = $_POST['lname'];
$b_address = $_POST['b_address'];
$h_address = $_POST['address'];
$note = $_POST['note'];
$country = $_POST['country'];
$city = $_POST['city'];
$fax = $_POST['fax'];
$job = $_POST['job'];
$company = $_POST['company'];
$web = $_POST['web'];
$email = $_POST['email'];

if (preg_match("/^[-0-9a-z]+(\.[0-9a-z-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.[a-z]{2,4}$/",$email))
	{
		$insert=mysql_query("update contact set fname='$fname',mname='$mname',lname='$lname',job='$job',company='$company',bus_phone='$bus_phone',home_phone='$home_phone',mob_phone='$mob_phone',fax='$fax',email='$email',web='$web',h_address='$h_address',b_address='$b_address',city='$city',country='$country',note='$note' where id='$refid'") or die("couln't enter any records!".mysql_error());
		if(mysql_affected_rows()>0)
		{

		$m="Succesfully updated";
	
		}
		

	
	}
	else
	{$m="Invalid Email Address";
	}

}
else
{
$m="Essiential Information can not be left blank";
}
echo $m;
?>

