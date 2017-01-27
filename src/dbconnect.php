<?php
$conn=mysql_connect("localhost","root","","chargingdb");
if(!$conn)
{
echo "connection error";
}
mysql_select_db("chargingdb",$conn) or die(mysql_error());

?>