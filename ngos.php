<?php
require_once "config.php";
$sql = "SELECT * FROM ngos";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>NGO List</title>
</head>
<body class="bg-light">
    <div class="container my-5">
        <h2 class="mb-4">Registered NGOs</h2>
        <div class="row">
            <?php while($ngo = mysqli_fetch_assoc($result)): ?>
                <div class="col-md-4 mb-3">
                    <div class="card p-3 shadow-sm">
                        <h5><?php echo htmlspecialchars($ngo['name']); ?></h5>
                        <p class="text-muted"><?php echo htmlspecialchars($ngo['description']); ?></p>
                        <a href="<?php echo $ngo['website_url']; ?>" target="_blank" class="btn btn-outline-primary btn-sm">Visit Website</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>