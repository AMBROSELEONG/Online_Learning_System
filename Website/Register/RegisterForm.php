<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body style="background-image: url(../img/background.jpg);">
    <div class="container">
        <div class="row ">
            <div class="col"></div>
            <div class="col-sm-6 p-3 my-3"
                style="backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px); background-color: rgba(255,255, 255, 0.2);">
                <h1 style="text-align: center; color: gray;">Registration Form</h1>
                <form id="registrationForm" action="index.php" method="post">
                    <div class="form-group">
                        <label for="username" style="color: gray;">Username</label>
                        <input type="text" class="form-control" id="UserName" name="UserName"
                            placeholder="Username can only contain letters and numbers." required>
                    </div>

                    <div class="form-group">
                        <label for="password" style="color: gray;">Password</label>
                        <input type="password" class="form-control" id="PasswordHash" name="Password"
                            placeholder="At least 8 characters, one uppercase, one lowercase, one number, one special character"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="repeatpassword" style="color: gray;">Repeat Password</label>
                        <input type="password" class="form-control" id="repeatpassword" name="repeatpassword" required>
                    </div>

                    <div class="form-group">
                        <label for="contact" style="color: gray;">Contact Number</label>
                        <input type="tel" class="form-control" id="ContactNumber" name="ContactNumber"
                            placeholder="Please enter a valid 10-digit phone number." required>
                    </div>

                    <div class="form-group">
                        <label for="email" style="color: gray;">Email</label>
                        <input type="email" class="form-control" id="Email" name="Email"
                            placeholder="Please enter a valid email address." required>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                        <label class="form-check-label" for="terms" style="color: gray;">Agree with terms and
                            privacy</label>
                    </div>
                    <p>Already registered? Go <span style="color: blue; cursor: pointer;"><a
                                href="../Login/Login.php">Login
                                Now</a></span></p>
                    <?php if (!empty($errors)) : ?>
                        <div class="alert alert-warning" role="alert">
                            <strong>Error(s) occurred:</strong>
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary" id="submit" name="submit"
                        style="background-color: rgb(255, 140, 0);">Submit</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>