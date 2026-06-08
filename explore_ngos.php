<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore NGOs - ShareSphere</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        html, body { height: 100%; margin: 0; }
        body { background: #F8FAFC; font-family: Arial, sans-serif; display: flex; flex-direction: column; }
        .main-content { flex: 1 0 auto; }
        .navy-footer { background-color: #0B192C; color: white; padding: 20px 0; }
        .footer-social-icons a { color: white; font-size: 1.3rem; margin-left: 20px; transition: color 0.3s; }
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
                <a href="index.php" class="nav-link me-3 fw-semibold text-dark">Home</a>
                <a href="explore_ngos.php" class="nav-link me-4 active fw-semibold text-primary">NGOs</a>
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

<div class="main-content py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5 bg-white">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-dark mb-2">Our Verified NGO Partners</h2>
                        <p class="text-muted mb-4">Connect with local organizations to support their noble causes.</p>
                        
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ngoModal" style="background: #7C3AED; border: none;">
                            <i class="fa-solid fa-plus"></i> Suggest an NGO
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th><th>NGO Name</th><th>Email Address</th><th>Contact Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                require_once "config.php";
                                $res = mysqli_query($conn, "SELECT * FROM ngos");
                                if(mysqli_num_rows($res) > 0):
                                    while($row = mysqli_fetch_assoc($res)): ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                                            <td><?php echo htmlspecialchars($row['contact']); ?></td>
                                        </tr>
                                    <?php endwhile;
                                else: ?>
                                    <tr><td colspan="4" class="text-center py-5 text-muted">No NGOs registered yet.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ngoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="submit_ngo.php" method="POST">
        <div class="modal-header"><h5 class="modal-title">Suggest an NGO</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
        <div class="modal-body">
          <div class="mb-3"><label>NGO Name:</label><input type="text" name="name" class="form-control" required></div>
          <div class="mb-3"><label>Email Address:</label><input type="email" name="email" class="form-control" required></div>
          <div class="mb-3"><label>Contact Number:</label><input type="text" name="contact" class="form-control" required></div>
        </div>
        <div class="modal-footer"><button type="submit" class="btn btn-success">Submit</button></div>
      </form>
    </div>
  </div>
</div>

<footer class="navy-footer shadow-lg mt-auto">
    <div class="container text-center text-md-start">
        <div class="row align-items-center">
            <div class="col-md-7"><span class="fw-bold">ShareSphere Platform</span> | <i class="fa-solid fa-envelope"></i> support@sharesphere.org</div>
            <div class="col-md-5 text-md-end footer-social-icons">
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