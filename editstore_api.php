<?php 
    include 'connn.inc';
    $newdata = explode(",",$_POST['udata']);
    $key = explode(",",$_POST['key']);
    $strUpdate ="";
    for($i=1;$i<=182;$i++){
        if($strUpdate ==""){           
            $strUpdate = $key[$i]." = '".$newdata[$i]."'";
        }else{
            $strUpdate = $strUpdate.", ".$key[$i]." = '".$newdata[$i]."'";
        }
    }
    $sql = 'UPDATE store_list SET '.$strUpdate.' WHERE store_name =\''.$newdata[0].'\'' ;

    $link->query($sql);

     echo $sql;
     $link = null;
 ?>

