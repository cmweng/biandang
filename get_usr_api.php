<?php 
	$no = $_POST["no"];
	include 'connn.inc';

    $nul = "NULL";
    $sql = 'Select * from user where no = "'.$no.'"';
    $result = $link->prepare($sql);
    $result->execute();
    $row = $result->fetch(PDO::FETCH_BOTH);
    echo json_encode($row);
    $link = null;

 ?>
