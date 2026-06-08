<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";

$user_id = $_SESSION["id"];
$sql = "SELECT id, item_type, description, pickup_address, status, created_at FROM donations WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ShareSphere</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        html, body { height: 100%; }
        body { background: #F8FAFC; font-family: Arial, sans-serif; display: flex; flex-direction: column; }
        .content-wrapper { flex: 1; }
        .custom-btn { background: #7C3AED; color: white; border: none; padding: 8px 16px; border-radius: 8px; text-decoration: none; }
        .custom-btn:hover { background: #6D28D9; color: white; }
        .dashboard-card { background: #ffffff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); padding: 30px; }
        .status-badge { padding: 5px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; }
        /* for footer styling */
        .navy-footer { background-color: #0B192C; color: white; padding: 20px 0; }
        .footer-social-icons a { color: white; font-size: 1.2rem; margin-left: 15px; }
    </style>
</head>
<body>

<div class="content-wrapper">
    <nav class="navbar navbar-expand-lg bg-white shadow-sm py-2">
        <div class="container">
            <a class="navbar-brand d-flex flex-column text-dark" href="index.php" style="line-height: 1.2;">
                <span class="fw-bold fs-3" style="letter-spacing: -0.5px;">ShareSphere</span>
                <span class="fs-6 fw-normal text-muted" style="font-style: italic;">Turning unused items into hope</span>
            </a>
            <div class="ms-auto align-items-center d-flex">
                <a href="index.php" class="nav-link me-3 fw-semibold">Home</a>
                <span class="navbar-text fw-semibold me-3 text-dark">
                    <i class="fa-solid fa-user text-muted me-1"></i> Hi, <?php echo htmlspecialchars($_SESSION["name"]); ?>
                </span>
                <a class="btn btn-outline-danger btn-sm" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card dashboard-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold mb-0">Your Donations History</h3>
                        <a href="donate.php" class="custom-btn"><i class="fa-solid fa-plus me-1"></i> New Donation</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr><th>Date</th><th>Item Type</th><th>Description</th><th>Pickup Address</th><th>Status</th><th>Action</th></tr>
                            </thead>
                            <tbody>
                                <?php if(mysqli_num_rows($result) > 0): ?>
                                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                                        <tr id="row-<?php echo $row['id']; ?>">
                                            <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                                            <td class="fw-semibold"><?php echo htmlspecialchars($row['item_type']); ?></td>
                                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                                            <td><?php echo htmlspecialchars($row['pickup_address']); ?></td>
                                            <td><span class="status-badge bg-light border"><?php echo ucfirst($row['status']); ?></span></td>
                                            <td>
                                                <button onclick="deleteDonation(<?php echo $row['id']; ?>)" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash-can"></i></button>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr><td colspan="6" class="text-center py-4 text-muted">No donations yet.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="navy-footer shadow-lg mt-auto">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7 text-center text-md-start">
                <span class="fw-bold">ShareSphere Platform</span> | <i class="fa-solid fa-envelope"></i> support@sharesphere.org
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

<script>
function deleteDonation(donationId) {
    if(confirm('Are you sure you want to delete?')) {
        fetch('delete_donation.php?id=' + donationId)
        .then(response => response.text())
        .then(data => { if(data.trim() === "success") location.reload(); });
    }
}
</script>
</body>
</html>