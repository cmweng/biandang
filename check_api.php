<?php 
 
    // $_SEESION['$oname'] = $_POST[''];

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
        $no="no_".$_POST["no"]."_check";
        $oname = $_POST["today"];
        include 'connn.inc';
        $sql = 'SELECT ip from order_record WHERE order_name =\''. $oname.'\'';
        $result = $link->prepare($sql);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_BOTH);

    if ($row[0] != $ip){
        exit();
    } else {
        $no="no_".$_POST["no"]."_check";
        $oname = $_POST["today"];

        $sql = 'SELECT '.$no.' from order_record WHERE order_name =\''. $oname.'\'';

        $result = $link->prepare($sql);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_BOTH);
      
        $nul = "NULL";

        if ($row[0]==1){
            $sql = 'UPDATE order_record SET '.$no.' = '.$nul.' WHERE order_name =\''. $oname.'\'';
            $link->query($sql);
        } else {
            $sql = 'UPDATE order_record SET '.$no.' = 1 WHERE order_name =\''. $oname.'\'';
            $link->query($sql);
        }
        $link = null;
    }
    

    
    
 ?>
