<?php

    session_start();

    include '../LoginForm/LoginForm.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            
            $query ="select * from form where UserName ='$username' limit 1";
            $result = mysqli_query($conn, $query);
        }

        if($result){
            if($result && mysqli_num_rows($result) > 0)
            {

                $username =mysqli_fetch_assoc($result);

                if($username['password'] == $password)
                {

                    header("location: MainPage.html");

                    die;       
                }

            }
        }
         
        echo "<script type='text/javascript'> alert('wrong username or password')</script>";

    }
    else{

         echo "<script type='text/javascript'> alert('wrong username or password')</script>";
    }
?>




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
                <form id="registrationForm">
                    <div class="form-group">
                        <label for="username" style="color: gray;">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="password" style="color: gray;">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <p>Not registered yet? <span style="color: blue; cursor: pointer;"><a href="RegisterForm.html"> Register
                                Now</a></span></p>
                    <p style="color: blue; cursor: pointer;"><a href="ForgetPassword.html">Forget User Name or Password?</a></p>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary"
                        style="background-color: rgb(255, 140, 0);">Login</button>
                </form>

                <?php
                if(isset($_GET["error"])){
                    if($_GET["error"] == "emptyinput"){
                        echo "<p>Fill in all fields!</p>";
                    }
                    else if($_GET["error"] == "invaliduid"){
                        echo "<p>Fill in a proper username!</p>";
                    }
                    else if($_GET["error"] == "passworddontmatch"){
                        echo "<p>Password doesn't match!</p>";
                    }
                    else if($_GET["error"] == "stmfailed"){
                        echo "<p>Something wnet wrong!</p>";
                    }
                    else if($_GET["error"] == "usernametaken"){
                        echo "<p>Username already taken!</p>";
                    }
                    else if($_GET["error"] == "passworddontmatch"){
                        echo "<p>Password doesn't match</p>";
                    }
                    else if($_GET["error"] == "none"){
                        echo "<p>You have signed up!</p>";
                    }
                }
        ?>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>