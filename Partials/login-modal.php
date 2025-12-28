<style>
    /* Blur the background when modal is open */
    .modal-backdrop.show {
        backdrop-filter: blur(5px);
        background-color: rgba(0, 0, 0, 0.5);
        /* Optional: soft dark overlay */
    }
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Modal -->
<?php include 'Partials/db-connection.php'; ?>

<div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodalLabel" aria-hidden="true">
    <form method="POST" id="LoginForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginmodalLabel">Log in</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">

                    <div id="error" class="alert alert-danger" style="display: none;" role="alert">
                        Incorrect email or password. Please try again.
                    </div>

                    <div class="form-check" style="padding-right: 1.5em;">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                    </div>


                    <div class="form-check" style="padding-right: 1.5em;">
                        <label for="password" class="col-form-label">Password</label>
                        <div class="pp">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="login col-12 mt-2" style=" align-items: center;">
                            <button class="btn btn-primary" type="button" style="background-color:green"
                                onclick="checkin();" name="login">Log in
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>


<script>
    function checkin() {
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            url: 'Partials/login-check.php',
            type: 'POST',
            data: {
                email: email,
                password: password,
            },
            success: function (response) {
                console.log("Server response:", response); 
                if (response.trim() == "1") {
               
                    window.location.href = 'index.php';
                } else if (response.trim() == "0") {
                    $("#error").show();
                } else {
                    alert(response);
                }
            },
            /* error: function (xhr, status, error) {
                console.error("AJAX error:", status, error);
            } */
        });
    }

</script>