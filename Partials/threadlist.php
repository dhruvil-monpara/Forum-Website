<?php
session_start();
$id = $_GET['catid'];
include 'db-connection.php';
$category = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM category WHERE category_id='$id'"));
$threads = mysqli_query($conn, "SELECT * FROM thread WHERE thread_cat_id='$id' ORDER BY time DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <base href="http://localhost/forum/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($category['category_name']); ?> - Threads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f1f3f5;
            font-family: "Segoe UI", sans-serif;
        }
        .category-header {
            background-color: #fff;
            border-left: 5px solid #0d6efd;
            padding: 1.5rem;
            border-radius: 5px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .category-header h1 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .category-header p {
            color: #6c757d;
            margin: 0;
        }
        .thread-list {
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
            overflow: hidden;
        }
        .thread-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e9ecef;
            transition: background-color 0.2s;
        }
        .thread-item:hover {
            background-color: #f8f9fa;
        }
        .user-dp {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
            border: 1px solid #ced4da;
        }
        .thread-content {
            flex-grow: 1;
            min-width: 0; /* important for text truncation */
        }
        .thread-title {
            font-size: 1rem;
            font-weight: 600;
            color: #0d6efd;
            text-decoration: none;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .thread-title:hover {
            text-decoration: underline;
        }
        .thread-desc {
            font-size: 0.88rem;
            color: #495057;
            margin-top: 0.2rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .thread-meta {
            font-size: 0.75rem;
            color: #868e96;
            margin-top: 0.4rem;
            white-space: nowrap;
        }
        .meta-separator::after {
            content: "•";
            margin: 0 0.5rem;
            color: #adb5bd;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="category-header">
        <h1><?php echo htmlspecialchars($category['category_name']); ?></h1>
        <p><?php echo nl2br(htmlspecialchars($category['category_dec'])); ?></p>
    </div>

    <div class="thread-list">
        <?php while($row = mysqli_fetch_assoc($threads)): ?>
            <?php $replies = rand(0, 40); // placeholder ?>
            <div class="thread-item">
                <img src="upload/user.jpeg" alt="User DP" class="user-dp">
                <div class="thread-content">
                    <a href="Partials/thread.php?threadid=<?= $row['thread_id'] ?>" class="thread-title">
                        <?= htmlspecialchars($row['thread_title']) ?>
                    </a>
                    <div class="thread-desc">
                        <?= htmlspecialchars(substr($row['thread_dec'], 0, 120)) ?>...
                    </div>
                    <div class="thread-meta">
                        <span>User: <?= htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?></span>
                        <span class="meta-separator"></span>
                        <span><?= date('M d, Y - H:i', strtotime($row['time'])) ?></span>
                        <span class="meta-separator"></span>
                        <span>💬 <?= $replies ?> replies</span>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
