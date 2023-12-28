<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<style>
    .centered-form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
</style>

<body style="background-image: url(../img/background.jpg);">
    <div class="container">
        <div class="row centered-form">
            <div class="col"></div>
            <div class="col-sm-6 p-3 my-3"
                style="backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px); background-color: rgba(255,255, 255, 0.2);">
                <h1 style="text-align: center; color: gray;">Forget User Name or Password</h1>
                <form id="registrationForm" style="text-align: center;" action="email-verify.php" method="post">
                    <div class="form-group">
                        <label for="username" style="color: gray;">Enter your username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                        <label for="email" style="color: gray;">Enter your email to verify and reset the
                            password</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <?php
                    session_start();
                    ?>
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>
                                <?php echo $_SESSION['error']; ?>
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <button type="reset" class="btn btn-secondary"
                        onclick="window.location.href='../Login/Login.php'">Back to Login</button>
                    <button type="submit" class="btn btn-primary"
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