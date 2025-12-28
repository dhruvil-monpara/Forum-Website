<?php
session_start();

// Dummy data
$username = $_SESSION['username'] ?? "John Doe";
$email= $_SESSION['email'] ??"abc@gmail.com";
$joined_date = "June 1, 2024";
$bio = "Full-stack developer with a passion for open source and community building.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <base href="http://localhost/forum/" />
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($username); ?>'s Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts + Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #4A90E2;
            --background: #f0f2f5;
            --card-bg: rgba(255, 255, 255, 0.75);
            --card-blur: blur(20px);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--background);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .glass-card {
            background: var(--card-bg);
            backdrop-filter: var(--card-blur);
            -webkit-backdrop-filter: var(--card-blur);
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 30px;
        }

        .profile-avatar {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            margin-top: -90px;
            background: #f8f9fa;
        }
        page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .username {
            font-size: 28px;
            font-weight: 600;
        }

        .fade-in {
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

       

        .btn-edit {
            border-radius: 25px;
            padding: 8px 24px;
            font-weight: 500;
        }

        footer {
            background: #f1f1f1;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #555;
        }

    </style>
</head>
<body>
 <div class="page-container">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/forum">CodeChat</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="Partials/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Profile Section -->
<div class="container fade-in">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="glass-card text-center position-relative">
                <!-- Avatar -->
                <div class="text-center">
                    <img src="upload/user.jpeg" class="profile-avatar shadow" alt="User Avatar">
                </div>

                <!-- User Info -->
                <div class="mt-3">
                    <div class="username"><?php echo htmlspecialchars($username); ?></div>
                    <p class="text-muted mb-1"><?php echo htmlspecialchars($email); ?></p>
                  
                </div>

                <hr>

                <!-- Bio -->
                <p class="mb-3 text-dark"><?php echo htmlspecialchars($bio); ?></p>
                <a href="Partials/edit_profile.php" class="btn btn-outline-primary btn-edit">Edit Profile</a>
            </div>

            <!-- User Threads -->
       

<!-- Footer -->
<footer>
    &copy; <?php echo date("Y"); ?> CodeChat. All rights reserved.
</footer>
</div>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
