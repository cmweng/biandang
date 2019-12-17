<?php 
    $oname = $_POST["today"];
    include 'connn.inc';
    $sql = 'SELECT store_name from order_record WHERE order_name =\''. $oname.'\'';
    $result = $link->query($sql);
    $result =$result -> fetch(PDO::FETCH_OBJ);
    $link=null;
    // print_r($result->store_name);

    include 'order_list.inc';
    $order_list=new order_list();
    $order_list->show_menu($result->store_name);

 ?>
