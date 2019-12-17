<?php
$user="";
$pass="";
try {
    if($link = new PDO('mysql:host=localhost;dbname=biandang', $user,$pass)) ;
    $link->query('SET NAMES utf8');

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
