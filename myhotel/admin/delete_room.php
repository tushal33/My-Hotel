<?php
require_once "../config.php";

$id = $_GET['id'];

$sqldelete =" DELETE FROM rooms WHERE id = id";

if($con->query($sqldelete) === TRUE){
    header('location:rooms.php');
}else{
    echo "Error: ".$sqldelete."<br>". $con->error;
}
?>