<?php include 'db-connection.php';
session_start(); ?>
<?php

if (!isset($_SESSION['user_id'])) {
    echo "NOT_LOGGED_IN";
    exit;
} ?>

<?php
if (isset($_POST["action"]) && $_POST["action"] == 'add_comment') {
    Add_Comment();
}
function Add_Comment(): void
{

    global $conn;
    $user_name = $_SESSION['username'];
    $comment = $_POST['comment'];
    $thread_id = $_POST['thread_id'];
    $sql = "INSERT INTO `comment` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$thread_id', '$user_name', current_timestamp())";
    $result = $conn->query($sql);
    echo '1';
}
    
?>
