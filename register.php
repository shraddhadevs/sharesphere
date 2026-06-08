<?php
require_once "config.php";

$message = "";
$message_class = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));
    $role = mysqli_real_escape_string($conn, trim($_POST['role']));
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $sql_check = "SELECT id FROM users WHERE email = '$email'";
    $result_check = mysqli_query($conn, $sql_check);
    
    if(mysqli_num_rows($result_check) > 0){
        $message = "This email is already registered!";
        $message_class = "alert-danger";
    } else {
        $sql = "INSERT INTO users (name, email, phone, role, password) VALUES ('$name', '$email', '$phone', '$role', '$hashed_password')";
        if(mysqli_query($conn, $sql)){
            header("location: login.php");
            exit;
        } else {
            $message = "Something went wrong. Please try again.";
            $message_class = "alert-danger";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ShareSphere</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #F8FAFC; font-family: Arial, sans-serif; min-height: 100vh; display: flex; flex-direction: column; }
        .custom-btn { background: #7C3AED; color: white; border: none; padding: 10px 20px; border-radius: 8px; transition: 0.3s; }
        .custom-btn:hover { background: #6D28D9; color: white; }
        .register-card { background: #ffffff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); padding: 40px 30px; width: 100%; max-width: 450px; margin: 40px auto; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white shadow-sm py-2">
    <div class="container">
        <a class="navbar-brand d-flex flex-column text-dark" href="index.php" style="line-height: 1.2;">
            <span class="fw-bold fs-3" style="letter-spacing: -0.5px;">ShareSphere</span>
            <span class="fs-6 fw-normal text-muted" style="font-style: italic;">Turning unused items into hope</span>
        </a>
    </div>
</nav>

<div class="register-card">
    <h3 class="fw-bold text-center mb-4">Create an Account</h3>
    
    <?php if(!empty($message)): ?>
        <div class="alert <?php echo $message_class; ?> text-center"><?php echo $message; ?></div>
    <?php endif; ?>
    
    <form action="register.php" method="POST">
        <div class="mb-3">
            <label class="form-label fw-semibold">Full Name / NGO Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Email Address</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Phone Number</label>
            <input type="tel" class="form-control" name="phone" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Register As</label>
            <select class="form-select" name="role" required>
                <option value="" disabled selected>Select your role</option>
                <option value="donor">Donor</option>
                <option value="ngo">NGO</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="custom-btn w-100 mt-3 py-2 fw-semibold">Sign Up</button>
        
        <div class="text-center mt-4">
            <p class="small text-muted mb-0">
                Already have an account? 
                <a href="login.php" class="text-decoration-none fw-bold" style="color: #7C3AED;">Login</a>
            </p>
        </div>
    </form>
</div>

</body>
</html>