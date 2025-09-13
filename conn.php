<?php
    $server_name="localhost";
    $user_name="root";
    $password="";
    $database_name="student_management";

    $conn=mysqli_connect($server_name,$user_name,$password,$database_name) or die("Failed to connect:".mysqli_connect_error());

    // if(!$conn){
    //     die("Failed to connect:".mysqli_connect_error());
    // }
?>