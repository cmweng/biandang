<?php 
    //此aoi功能：確認今日訂單是否已產生
    $oname = $_POST["today"];
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
