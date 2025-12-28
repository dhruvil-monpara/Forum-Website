<?php
session_start();
include 'db-connection.php';
?>
    <?php
   
            global $conn;
            $email = $_POST['email'];
            $password = $_POST['password'];

            $Checkmail = "SELECT * FROM `signup` WHERE `email` = '$email' AND `password` = '$password'";
            $checkResult = mysqli_query($conn, $Checkmail);
            $row = mysqli_fetch_array($checkResult);
            $num = mysqli_num_rows($checkResult);

            if($num == 1) {             
              $_SESSION["username"] = $row['fname'] . " " . $row['lname'];
              $_SESSION['user_id'] = $row['id'];
              $_SESSION['email'] = $row['email'];
              $_SESSION['user_type'] = $row['user_type'];

                echo 1;
            } else {
                echo 0;
            }
    
        
    ?>
