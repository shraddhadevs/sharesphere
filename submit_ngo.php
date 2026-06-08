<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $url = mysqli_real_escape_string($conn, $_POST['website_url']);

    // ave directly without any issue
    $sql = "INSERT INTO ngos (name, description, website_url) VALUES ('$name', '$description', '$url')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Successfully Add NGO !'); window.location='ngos.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>