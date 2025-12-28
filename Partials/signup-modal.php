<?php include 'Partials/db-connection.php'; ?>
<!-- Modal -->
<style>
  /* Blur the background when modal is open */
  .modal-backdrop.show {
    backdrop-filter: blur(5px);
    background-color: rgba(0, 0, 0, 0.3); /* Optional: soft dark overlay */
  }
</style>

<div class="modal fade" id="SignupModal" tabindex="-1" aria-labelledby="SignupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SignupModalLabel">Sign In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php" class="row  needs-validation " method="post" novalidate>
                    <div class=" form-check col-md-6">
                        <label for="validationCustom01" class="form-label">First name</label>
                        <input type="text" class="form-control" id="validationCustom01" name="fname" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="form-check col-md-6">
                        <label for="validationCustom02" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="validationCustom02" name="lname" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="form-check">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" name="email"
                            placeholder="name@example.com">
                    </div>

                    <div class="form-check">
                        <label for="password" class="col-form-label">Password</label>
                        <div class="pp">
                            <input type="password" class="form-control" id="inputPassword" name="password">
                        </div>
                        Gender:
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1"
                                value="Male" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2"
                                value="Female">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Female
                            </label>
                        </div>
                     <div class="col-12 mt-2">
                <button  class="btn btn-primary" type="submit" style="background-color:green" name="fsubmit" >Sign Up
                  </button>
            </div>    
                </form>
            </div>
           
        </div>
    </div>
</div>
<?php
    if (isset(($_POST['fsubmit']))) {

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $Pword = $_POST['password'];
        $gender = $_POST['gender'];


        $Checkmail = "SELECT * FROM signup WHERE email = '$email'";
        $checkResult = mysqli_query($conn, $Checkmail);
        $num = mysqli_num_rows($checkResult) ;
        if ($num < 1) {
            $sql = "INSERT INTO `signup`(`id`, `fname`, `lname`, `email`, `password`, `gender`) VALUES ('','$fname','$lname','$email','$Pword','$gender')";
            $result = $conn->query($sql);
            header("location:forum/index.php ");
          


        } else {
            ?>
            <script>alert("Email is already in Use.")</script><?php
        }

    }

    ?>
