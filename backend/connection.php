<?php
$servername = "localhost";
$username= "root";
$password= "";
$database = "new_school";

$conn = mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    die("sorry we failed to connect: <br>". mysqli_connect_error());
}
?>