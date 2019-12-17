<?php 
    include 'connn.inc';
    $sname = $_POST['sname'];

    $sql ="DELETE FROM store_list WHERE store_name='".$sname."'";

    $link->query($sql);

     echo $sql;
     $link = null;
 ?>

