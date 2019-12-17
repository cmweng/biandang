<?php 
    $oname = $_POST["today"];
    include 'order_list.inc';
    include 'connn.inc';
    $sql = 'SELECT count(*) from order_record WHERE order_name =\''. $oname.'\'';
    $result = $link->query($sql);
    $rowcount = $result->fetchColumn();
    if($rowcount == 1 ){
        echo true; 
       } else {
        echo false;
       }
    $link = null;
 ?>
