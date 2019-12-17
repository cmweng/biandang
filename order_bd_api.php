<?php 
    $bdname = $_POST["bdname"];
    $no = $_POST["no"];
    $order_name = $_POST["order"];
    $order_no = "no_".$no ;
    include 'connn.inc';

    $sql = "UPDATE order_record SET ". $order_no . " = '" .$bdname. "' WHERE order_name = '".$order_name."'" ;
    if($link->query($sql)){
        echo true;
    } else {
        echo false;
    }
    $link=null;
 ?>
