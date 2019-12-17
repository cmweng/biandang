<?php 
$sname = $_POST["sname"];
include 'order_list.inc';
$order_list=new order_list();
$order_list->show_menu($sname);

 ?>
