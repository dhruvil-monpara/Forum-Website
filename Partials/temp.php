    <?php
    if (isset($_POST['login'])) {


        $email = $_POST['email'];
        $password = $_POST['password'];


        $Checkmail = "SELECT * FROM `signup` WHERE `email` = '$email' AND `password` = '$password'";
        $checkResult = mysqli_query($conn, $Checkmail);
        $num = mysqli_num_rows($checkResult);
        /* print_r($tot_rec);
        die(); */

        if ($num == 1) {
            session_start();
            $sql = "SELECT * FROM `signup` WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);

            $_SESSION["username"] = $row['fname'] . " " . $row['lname'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];


            ?>
        <script>window.location.href = 'http://localhost/forum/index.php'</script><?php
        } else {
            ?>
        <script>
            var login_failed = true;
            if(login_failed==true) {
            $(document).ready(function () {
               //show or popup modal
                
                $('#loginmodal').modal('show');

                // Show the error alert
                $("#error").show();
            });
        }
        </script>
        <?php

        }

    }
    ?>
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  <!-- Ajax Use for login -->
    <script>
        function checkin() {
            $(document).ready(function () {
                var email = $('#email').val();
                var password = $('#password').val();
                $.ajax({
                    url: 'Partials/login-check.php',
                    type: 'POST',
                    data: {
                        email: email,
                        password: password,
                        action: "check"
                    },
                    success: function (response) {
                        if (response==1) {
                            session_start();
                            $sql = "SELECT * FROM `signup` WHERE email='$email'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);

                            $_SESSION["username"] = $row['fname'] . " " . $row['lname'];
                            $_SESSION['user_id'] = $row['id'];
                            $_SESSION['email'] = $row['email'];
                            window.location.href = 'index.php';
                            alert("login success");
                        }
                        else if (response==0) {
                            alert("wrong");
                             $(document).ready(function () {
                                 //show or popup modal
                                 $('#loginmodal').modal('show');
                                 // Show the error alert
                                 $("#error").show();
                             });
                        }
                        else {
                            alert("wrong ds");
                            console.log("Server response:", response); 
                        }
                    }
                });
            });
        }
    </script>

    Ajax Function

    function checkin() {
    var email = $('#email').val();
    var password = $('#password').val();

    $.ajax({
        url: 'Partials/login-check.php',
        type: 'POST',
        data: {
            email: email,
            password: password,
            action: "check"
        },
        success: function (response) {
            console.log("Server response:", response); // DEBUGGING

            if (response.trim() == "1") {
                alert("Login success");
                window.location.href = 'index.php';
            } else if (response.trim() == "0") {
                $("#loginmodal").modal('show');
                $("#error").show();
            } else {
                alert("Unexpected response: " + response);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX error:", status, error);
        }
    });
}
