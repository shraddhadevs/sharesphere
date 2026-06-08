<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

require_once "config.php";

$message = "";
$message_class = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = $_POST['password'];
    
    $sql = "SELECT id, name, email, password, role FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    
    if($result){
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];
            
            if(password_verify($password, $hashed_password)){
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $row['id'];
                $_SESSION["name"] = $row['name'];
                $_SESSION["role"] = $row['role'];
                header("location: index.php");
            } else {
                $message = "Invalid email or password.";
                $message_class = "alert-danger";
            }
        } else {
            $message = "No account found with that email.";
            $message_class = "alert-danger";
        }
    } else {
        $message = "Oops! Something went wrong. Please try again later.";
        $message_class = "alert-danger";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ShareSphere</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #F8FAFC; color: #1F2937; font-family: Arial, sans-serif; display: flex; flex-direction: column; min-height: 100vh; }
        .custom-btn { background: #7C3AED; color: white; border: none; padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-block; transition: 0.3s; }
        .custom-btn:hover { background: #6D28D9; color: white; }
        .login-card { background: #ffffff; border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); padding: 40px 30px; }
        .form-control:focus { border-color: #7C3AED; box-shadow: 0 0 0 0.25rem rgba(124, 58, 237, 0.25); }
        footer { background: #1F2937; color: #9CA3AF; margin-top: auto; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white shadow-sm py-2">
    <div class="container">
        <a class="navbar-brand d-flex flex-column text-dark" href="index.php" style="line-height: 1.2;">
            <span class="fw-bold fs-3" style="letter-spacing: -0.5px;">ShareSphere</span>
            <span class="fs-6 fw-normal text-muted" style="font-style: italic;">Turning unused items into hope</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link fw-semibold" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="explore_ngos.php">NGOs</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold text-primary" href="login.php">Login</a></li>
                <li class="nav-item ms-lg-2">
                    <a class="custom-btn" href="register.php">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-5" style="flex: 1; display: flex; align-items: center; justify-content: center;">
    <div class="row justify-content-center w-100">
        <div class="col-md-5 col-lg-4">
            <div class="card login-card">
                <h3 class="fw-bold text-center mb-2">Welcome Back</h3>
                <p class="text-muted text-center mb-4">Log in to your ShareSphere account.</p>
                
                <?php if(!empty($message)): ?>
                    <div class="alert <?php echo $message_class; ?> text-center"><?php echo $message; ?></div>
                <?php endif; ?>
                
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <label class="form-label fw-semibold">Password</label>
                            <a href="#" class="small text-decoration-none" style="color: #7C3AED;">Forgot?</a>
                        </div>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="custom-btn w-100 mt-3 py-2 fw-semibold">Log In</button>
                    <div class="text-center mt-4">
                        <p class="small text-muted mb-0">Don't have an account? <a href="register.php" class="text-decoration-none fw-bold" style="color: #7C3AED;">Register here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="py-4">
    <div class="container text-center">
        <p class="small mb-0">&copy; 2026 ShareSphere. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>