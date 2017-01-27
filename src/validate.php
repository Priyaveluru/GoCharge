<?php 

require_once('./dbconnect.php');
session_start(); 

$username = $_POST['username']; 
$password = $_POST['password']; 
 

echo $username;
echo $password;

 
$flag=0;
$emailid=$_POST['username'];
$password=$_POST['password'];

$sql="SELECT * from parking_user where emailid='$username' and password='$password'";
$result = mysql_query($sql) or die(mysql_error());
$numrows = mysql_num_rows($result);
if($numrows ==1)
   {

while ($row = mysql_fetch_array ($result)){
$flag=1;
}
   }
else
   {
    echo 'invalid username or password';
   }

if($flag==1)
{
   header("Location:http://localhost/smart-park/smart-park/src/show-area.php");
}
?>