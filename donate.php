<?php
// Session start
session_start();

//here you can check user is loged in or not (Optional)
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("location: login.php");
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate Items - ShareSphere</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* to make your page properly fit on the screen and keep the footer fixed at the bottom   */
        html, body {
            height: 100%;
            margin: 0;
        }
        body { 
            background: #F8FAFC; 
            font-family: Arial, sans-serif; 
            display: flex;
            flex-direction: column;
        }
        .main-content {
            flex: 1 0 auto; /* this content always keep lock footer of bottom  */
        }
        /* neavy blue social footer bar (same like all pages) */
        .navy-footer {
            background-color: #0B192C; 
            color: white;
            padding: 20px 0;
            font-size: 0.95rem;
            flex-shrink: 0;
            width: 100%;
        }
        .footer-social-icons a {
            color: white;
            font-size: 1.3rem;
            margin-left: 20px;
            transition: color 0.3s ease;
        }
        .footer-social-icons a:hover {
            color: #38BDF8; 
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand d-flex flex-column text-dark" href="index.php" style="line-height: 1.2;">
            <span class="fw-bold fs-3" style="letter-spacing: -0.5px;">ShareSphere</span>
            <span class="fs-6 fw-normal text-muted" style="font-style: italic;">Turning unused items into hope</span>
        </a>

        <div class="ms-auto align-items-center d-flex">
            <a href="index.php" class="nav-link me-3 fw-semibold text-dark">Home</a>
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
</nav>

<div class="main-content py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5 bg-white">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-dark mb-2">Donate Items</h2>
                        <p class="text-muted">Fill out the details below to schedule a donation.</p>
                    </div>

                    <form action="process_donation.php" method="POST">
                        <div class="mb-4">
                            <label for="item_type" class="form-label fw-bold text-secondary">What would you like to donate?</label>
                            <select class="form-select py-2.5" id="item_type" name="item_type" required style="border-radius: 8px;">
                                <option value="" selected disabled>Select Item Type</option>
                                <option value="Clothes">Clothes (कपडे)</option>
                                <option value="Books">Books (पुस्तके)</option>
                                <option value="Toys">Toys (खेळणी)</option>
                                <option value="Groceries">Groceries (किराणा/अन्न)</option>
                                <option value="Household">Household Items (घरगुती वस्तू)</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold text-secondary">Item Description & Quantity</label>
                            <textarea class="form-select py-2.5" id="description" name="description" rows="3" required placeholder="e.g., 5 pair of shirts, 10 story books in good condition..." style="border-radius: 8px; resize: none;"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="address" class="form-label fw-bold text-secondary">Pickup Address</label>
                            <textarea class="form-select py-2.5" id="address" name="address" rows="3" required placeholder="Enter your complete address for pickup..." style="border-radius: 8px; resize: none;"></textarea>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary py-2.5 fw-bold fs-5 shadow-sm" style="background: #7C3AED; border: none; border-radius: 8px;">
                                Submit Donation
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<footer class="navy-footer shadow-lg mt-auto">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 text-center text-md-start mb-3 mb-md-0">
                <span class="fw-bold me-3">ShareSphere Platform</span> | 
                <span class="ms-2"><i class="fa-solid fa-envelope me-1"></i> support@sharesphere.org</span>
            </div>
            
            <div class="col-md-5 text-center text-md-end footer-social-icons">
                <a href="https://facebook.com" target="_blank" title="Facebook"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://instagram.com" target="_blank" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://linkedin.com" target="_blank" title="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
                <a href="https://twitter.com" target="_blank" title="Twitter"><i class="fa-brands fa-twitter"></i></a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>