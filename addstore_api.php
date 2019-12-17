<?php 

    $store = $_POST["store"];
    $data_col = $_POST["data_col"];
    include 'connn.inc';

    $sql = "INSERT INTO store_list (".$data_col.") VALUES (". $store .")"; 
    $link->query($sql);
            echo $sql;
    $link = null;

 ?>
