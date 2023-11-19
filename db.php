<?php 
$con = mysqli_connect("localhost","root","","movie_db");
if(!$con){
    die("Connection Error: " . mysqli_connect_error());
}
?>
