<?php
// Session start
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareSphere - Donation & Reuse Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        html { height: 100%; }
        body { 
            background: #F8FAFC; 
            font-family: Arial, sans-serif; 
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-content { flex: 1 0 auto; }
        .custom-btn { 
            background: #7C3AED; color: white; border: none; padding: 12px 24px; 
            border-radius: 8px; text-decoration: none; display: inline-block; font-weight: 600;
        }
        .custom-btn:hover { background: #6D28D9; color: white; }
        .hero-title { font-size: 3.5rem; font-weight: 800; color: #0F172A; line-height: 1.2; }
        .navy-footer { background-color: #0B192C; color: white; padding: 20px 0; font-size: 0.95rem; }
        .footer-social-icons a { color: white; font-size: 1.3rem; margin-left: 20px; transition: 0.3s; }
        .footer-social-icons a:hover { color: #38BDF8; }
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
            <div class="ms-auto align-items-center d-flex">
                <a href="index.php" class="nav-link me-3 active fw-semibold text-primary">Home</a>
                <a href="explore_ngos.php" class="nav-link me-4 fw-semibold text-dark">NGOs</a>
                
                <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                    <span class="navbar-text fw-semibold me-3 text-dark">
                        <i class="fa-solid fa-user text-muted me-1"></i> Hi, <?php echo htmlspecialchars($_SESSION["name"]); ?>
                    </span>
                    <a class="btn btn-outline-danger btn-sm px-3" href="logout.php" style="border-radius: 6px;">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="nav-link me-3 fw-semibold text-dark">Login</a>
                    <a class="btn btn-primary btn-sm px-3" href="register.php" style="background: #7C3AED; border: none; border-radius: 6px;">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<div class="main-content d-flex align-items-center py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="hero-title mb-4">Give Unused<br>Items a New<br>Purpose</h1>
                <p class="text-muted fs-5 mb-4" style="max-width: 500px;">
                    Connect with verified NGOs and donate clothes, books, toys, household items and groceries.
                </p>
                <div class="gap-3 d-flex">
                    <a href="donate.php" class="custom-btn shadow-sm">Donate Now</a>
                    <a href="explore_ngos.php" class="btn btn-outline-secondary px-4 py-2 fw-semibold" style="border-radius: 8px;">Explore NGOs</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?q=80&w=600&auto=format&fit=crop" 
                     alt="Donation" class="img-fluid rounded-4 shadow" style="max-height: 400px; width: 100%; object-fit: cover;">
            </div>
        </div> 
    </div> 
</div> 

<footer class="navy-footer shadow-lg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 text-center text-md-start mb-3 mb-md-0">
                <span class="fw-bold me-3">ShareSphere Platform</span> | 
                <span class="ms-2"><i class="fa-solid fa-envelope me-1"></i> support@sharesphere.org</span>
            </div>
            <div class="col-md-5 text-center text-md-end footer-social-icons">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin"></i></a>
               <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>