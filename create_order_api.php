<?php 


if (!empty($_SERVER['HTTP_CLIENT_IP']))
{
  $ip=$_SERVER['HTTP_CLIENT_IP'];
}
else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
  $ip=$_SERVER['REMOTE_ADDR'];
}



$sname = $_GET["sname"];
$oname = $_GET["today"];
$owner = $_GET["owner"];

include 'order_list.inc';
$order_list=new order_list();
$order_list->create_order($oname, $sname, $owner, $ip);
header("Location: index.php"); 
 ?>
