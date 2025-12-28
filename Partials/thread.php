<?php
session_start();
$id = $_GET['threadid'];

include 'db-connection.php';
$query = "SELECT * FROM `thread` WHERE `thread_id` = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<style>
    body {
        background: #f5f7fa;
        font-family: 'Segoe UI', sans-serif;
    }

    .thread-container {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .thread-title {
        font-weight: 700;
        color: #0d6efd;
    }

    .thread-description {
        font-size: 1.1rem;
        color: #343a40;
        line-height: 1.6;
    }

    .comment_box {
        background: #ffffff;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .comment-input {
        border-radius: 10px;
        resize: none;
        font-size: 15px;
        border: 1px solid #ced4da;
    }

    .comment-input:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .btn-comment {
        border-radius: 25px;
        padding: 10px 30px;
        font-weight: 500;
        background-color: #198754;
        color: white;
        transition: 0.3s ease;
    }

    .btn-comment:hover {
        background-color: #146c43;
        transform: translateY(-1px);
    }

    .comment-list {
        margin-top: 2rem;
    }

    .comment {
        background: #f8f9fa;
        padding: 1rem 1.25rem;
        border-radius: 10px;
        margin-bottom: 1rem;
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.05);
    }

    .comment-author {
        font-weight: 600;
        color: #0d6efd;
    }

    .comment-text {
        margin: 0.25rem 0 0.5rem;
        color: #333;
    }

    .comment-time {
        font-size: 0.85rem;
        color: #6c757d;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="http://localhost/forum/">
    <title>Thread</title>
</head>

<body>

    <div class="container mt-5">
        <script>

            function comment(id) {
                var comment_data = document.getElementById("comment_box").value;
                $.ajax({
                    url: 'Partials/Add_Comment.php',
                    type: 'POST',
                    data: {
                        comment: comment_data,
                        thread_id: id,
                        action: "add_comment"
                    },
                    success: function (response) {
                        if (response == 1) {
                            alert("Comment Added sucessfully");

                        }
                        else {
                            alert("Not Added");
                            console.log("Server response:", response);
                        }
                    }

                });
            }
        </script>
         <div class="thread-container">
            <h1 class="thread-title mb-3"><?php echo htmlspecialchars($row['thread_title']); ?></h1>
            <p class="thread-description"><?php echo nl2br(htmlspecialchars($row['thread_dec'])); ?></p>
        </div> 

        <?php if (isset($_SESSION['user_id'])): 
            $user_id = $_SESSION['user_id'];
            ?>
            <!-- Show comment form if logged in -->
            <div class="comment_box">
                <div class="form-floating mb-3">
                    <textarea class="form-control comment-input" placeholder="Leave a comment here" id="comment_box"
                        name="comment_box" style="height: 120px"></textarea>
                    <label for="floatingTextarea2">Your Comment</label>
                </div>

                <button type="button" class="btn btn-comment" onclick="comment(<?php echo $id; ?>)">Post Comment</button>
            </div>
        <?php else: ?>
            <!-- Show message if not logged in -->
            <div class="alert alert-warning mt-4">
                You must <a href="index.php">log in</a> to post a comment.
            </div>
        <?php endif; ?>



        <!-- Thread Info -->
             

        <!-- Comment Box -->
        <!--  <div class="comment_box">
            <div class="form-floating mb-3">
                <textarea class="form-control comment-input" placeholder="Leave a comment here" id="comment_box"
                    name="comment_box" style="height: 120px"></textarea>
                <label for="floatingTextarea2">Your Comment</label>
            </div>

            <button type="button" class="btn btn-comment" onclick="comment(<?php echo $id; ?>) ">Post
                Comment</button>
 -->

        <?php
        $query = "SELECT * FROM `comment` WHERE `thread_id` = '$id'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
            echo '<div class="comment-list mt-4">
                            <div class="comment">
                                <div class="comment-author">' . $row['comment_by'] . '</div>
                                 <pre>   <p class="comment-text">' . $row['comment_content'] . '</p></pre>
                                <div class="comment-time">' . $row['comment_time'] . '</div>    
                             </div>
                        </div>';

        }
        ?>


        <!-- Static Comment List -->
        <!--             <div class="comment-list mt-4">
            <div class="comment">
                <div class="comment-author">Amit Sharma</div>
                <p class="comment-text">I totally agree with your point. It's an important topic!</p>
                <div class="comment-time">Posted 1 hour ago</div>
            </div>
            
            <div class="comment">
                <div class="comment-author">Riya Patel</div>
                <p class="comment-text">Can someone explain this part more clearly? I'm a bit confused.</p>
                <div class="comment-time">Posted 2 hours ago</div>
            </div>
            
            <div class="comment">
                <div class="comment-author">Devansh Mehta</div>
                <p class="comment-text">Nice post! I've shared it with my classmates.</p>
                <div class="comment-time">Posted yesterday</div>
            </div>
        </div>
    </div>
</div>
-->


</script>
</body>

</html>