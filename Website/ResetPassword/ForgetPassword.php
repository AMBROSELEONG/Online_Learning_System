<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
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
                <h1 style="text-align: center; color: gray;">Forget User Name or Password</h1>
                <form id="registrationForm" style="text-align: center;">
                    <div class="form-group">
                        <label for="email" style="color: gray;">Enter your email to verify and reset the
                            password</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="reset" class="btn btn-secondary"
                        onclick="window.location.href='LoginForm.html'">Back to Login</button>
                    <button type="submit" class="btn btn-primary"
                        style="background-color: rgb(255, 140, 0);">Submit</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>