<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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

<body style="background-image: url(img/background.jpg);">
    <div class="container">
        <div class="row centered-form">
            <div class="col"></div>
            <div class="col-sm-6 p-3 my-3"
                style="backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px); background-color: rgba(255,255, 255, 0.2);">
                <h1 style="text-align: center; color: gray;">Login Form</h1>
                <form id="LoginForm" action="LoginFormPHP.php" method="post">
                    <div class="form-group">
                        <label for="username" style="color: gray;">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password" style="color: gray;">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <p>Not registered yet? <span style="color: blue; cursor: pointer;"><a href="RegisterForm.php">
                                Register
                                Now</a></span></p>
                    <p style="color: blue; cursor: pointer;"><a href="ForgetPassword.html">Forget User Name or
                            Password?</a></p>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary"
                        style="background-color: rgb(255, 140, 0);">Login</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>