<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdb";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("" . $conn->connect_error);
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>CodeChat</title>
</head>

<body>


    <?php include 'Partials/Header.php'; ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner" style="width: 100% ; height: 500px;">
            <div class="carousel-item active">
                <img alt="crypto" src="https://images.unsplash.com/photo-1508138221679-760a23a2285b"
                    class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1508138221679-760a23a2285b" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1508138221679-760a23a2285b" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <hr>
    <h2 style="text-align: center; ">Forum Categories</h2>
    <hr>
    <div class="container my-4">
        <div class="row">
            <?php include 'Partials/db-connection.php'; ?>
            <?php
            $sql = "SELECT * FROM `category` ";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result)) {
                $Category_name = $row['category_name'];
                $Category_img = $row['category_img'];
                $Category_description = $row['category_dec'];
                $words = explode(' ', $Category_description);
                $short_description = implode(' ', array_slice($words, 0, 10));
                if (count($words) > 10) {
                    $short_description .= '...';
                }

                echo '<div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                <img src="upload/' . $Category_img . '" class="img-fluid" style="width: 150px; height: 100%; object-fit: cover;" alt="Category Image">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">' . htmlspecialchars($Category_name) . '</h5>
                                   <p class="card-text">'. htmlspecialchars($short_description).'</p>
                                    <a href="#" class="btn btn-outline-success mt-auto">Go Thread</a>
                                </div>
                                </div>
                            </div>';

            }
            ?>
        </div>
    </div>


    <?php include 'Partials/login-modal.php';
    include 'Partials/signup-modal.php'; ?>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

</body>

</html>