<?php 
    $oname=$_POST["today"];
    $no ="no_".$_POST["no"];
    $no_check="no_".$_POST["no"]."_check";
    include 'connn.inc';
    $nul = "NULL";
    $sql = 'UPDATE order_record SET '.$no.' = '.$nul.', '.$no_check.' = '.$nul.' WHERE order_name =\''.$oname.'\'';
    if($link->query($sql)){
        echo true; 
       } else {
        echo false;
       }
    $link = null;
 ?>
