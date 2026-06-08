<?php
session_start();
require_once "config.php";

// १. make sure that only error and success massege print here 
// in this file should not have space html, echo 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    echo "Unauthorized";
    exit;
}

if(isset($_GET['id'])){
    $donation_id = intval($_GET['id']);
    $user_id = $_SESSION["id"];

    // delete query
    $sql = "DELETE FROM donations WHERE id = '$donation_id' AND user_id = '$user_id'";
    
    if(mysqli_query($conn, $sql)){
        echo "success"; // dashboard only want this word!S
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>