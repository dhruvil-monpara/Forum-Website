<?php include 'db-connection.php'; ?>
<!doctype html>
<html lang="en">

<head>

    <!-- #region -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>User Thread</title>
</head>



<?php include 'Header.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<!-- 🔧 Ask a Question Section -->
<form action="Partials/userthread.php" method="post">
    <div class="card shadow-sm p-4 mb-5"
        style="background: #ffffff; border-left: 4px solid #198754; border-radius: 8px; max-width: 800px; margin: auto;">
        <!-- Section Header -->
        <h5 class="fw-bold text-success mb-4">Submit a New Issue</h5>

        <!-- Title Field -->
        <div class="mb-3">
            <label for="problem_t" class="form-label text-secondary">Title</label>
            <input type="text" class="form-control custom-input" id="problem_t" name="problem_t"
                placeholder="Enter a short, clear title"></input>
        </div>

        <!-- Description Field -->
        <div class="mb-3">
            <label for="problem_dec" class="form-label text-secondary">Description</label>
            <textarea class="form-control custom-input" id="problem_dec" name="problem_dec" rows="4"
                placeholder="Describe the issue in detail" style="resize: none;"></textarea>
        </div>

        <!-- Category Dropdown -->
        <div class="mb-4">
            <label for="category" class="form-label text-secondary">Select Language Category</label>
            <select class="form-select custom-input" id="category" name="category">
                <option selected disabled>Choose a category...</option>
                <?php
                $sql = "SELECT * FROM `category`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    $Category_Name = $row["category_name"];
                    $Category_id = $row['category_id'];
                    echo '<option value="' . htmlspecialchars($Category_id) . '">' . htmlspecialchars($Category_Name) . '</option>';

                }
                ?>
            </select>
        </div>

        <!-- Submit Button -->
        <div class="text-end">
            <button type="submit" name="submit" id="submit" class="btn btn-success px-4">Post It</button>
        </div>
    </div>
</form>
<?php
if (isset($_POST['submit'])) {

    $Problem_Title = $_POST['problem_t'];
    $Problem_dec = $_POST['problem_dec'];
    $Option_Id = $_POST['category'];
    $userid = $_SESSION['user_id'];

    $sql = "INSERT INTO `thread`(`thread_title`,`thread_dec`,`thread_user_id`,`thread_cat_id`) VALUES ('$Problem_Title','$Problem_dec','$userid','$Option_Id')";
    $result = $conn->query($sql);

}

?>
<!-- UserThread -->


<div class="card shadow-sm p-4 mb-5"
    style="background: #ffffff; border-left: 4px solid #0d6efd; border-radius: 8px; max-width: 800px; margin: auto;">

    <!-- Header with Search -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h5 class="fw-bold text-primary mb-2 mb-md-0">Recent Threads</h5>

        <!-- Search Input -->
        <form class="d-flex" role="search">
            <input class="form-control form-control-sm me-2" type="search" placeholder="Search threads..."
                aria-label="Search" style="min-width: 200px;">
            <button class="btn btn-outline-primary btn-sm" type="submit">Search</button>
        </form>
    </div>

    <!-- Static Thread Items -->
    <?php
    $userid = $_SESSION['user_id'];
    $sql = "SELECT * FROM `thread` WHERE `thread_user_id`=$userid";
    $result = $conn->query($sql);

    while ($row = mysqli_fetch_array($result)) {
        $thread_id = $row["thread_id"];
        $category_id = $row["thread_cat_id"];
        $sql = "SELECT * FROM `category` WHERE `category_id` = $category_id";
        $result1 = $conn->query($sql);
        $row1 = mysqli_fetch_array($result1);
        $Category_Name = $row1['category_name'] ?? 'Unknown';

        echo '<div class="mb-4 p-3 border rounded" style="background-color: #f9f9fc;">
        <a href="Partials/thread.php?threadid=' . $thread_id . '" class="text-decoration-none text-dark fw-semibold fs-6 d-block mb-1">
            ' . htmlspecialchars($row['thread_title']) . '
        </a>
        <small class="text-muted">Posted in <strong>' . htmlspecialchars($Category_Name) . '</strong> • ' . $row['time'] . '</small>
    </div>';
    }

    ?>
</div>





</body>

</html>