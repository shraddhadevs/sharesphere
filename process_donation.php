<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION["id"];
    $item_type = mysqli_real_escape_string($conn, $_POST['item_type']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    
    // entry in database
    $sql = "INSERT INTO donations (user_id, item_type, description, pickup_address, status) 
            VALUES ('$user_id', '$item_type', '$description', '$address', 'pending')";
            
    if (mysqli_query($conn, $sql)) {
        // after success send this dirct on dashboard(where history visible)
        header("location: dashboard.php"); 
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>