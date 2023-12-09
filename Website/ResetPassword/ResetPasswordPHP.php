<?php
    if(isset($_POST['submit'])){ // Assuming the submit button has name="submit"

        $password = $_POST['password'];
        $passwordEncrypted = sha1($password); 
    
        $confpassword = $_POST['repeatpassword'];
        $confPasswordEncrypted = sha1($confpassword); 
    
        if($password !== $confpassword){
           echo "<script>alert('Passwords are not equal')</script>";
        } else {
            // Assuming Email and UserName are user inputs; make sure to sanitize them to prevent SQL injection
            $email = mysqli_real_escape_string($conn, $_POST['Email']);
            $username = mysqli_real_escape_string($conn, $_POST['UserName']);
    
            $select_query = "SELECT * FROM UserID WHERE Email = '$email' AND UserName = '$username'";
            $run_select_query = mysqli_query($conn, $select_query);
    
            if ($row_post = mysqli_fetch_array($run_select_query)) {
                $user_id = $row_post['id'];
    
                // Parameterized queries or at least sanitize user inputs to prevent SQL injection
                $update_posts = "UPDATE UserID SET PasswordHash='$passwordEncrypted' WHERE id='$user_id'";
                $run_update = mysqli_query($conn, $update_posts);
    
                if ($run_update) {
                    echo "<script>alert('Password Has been Updated!')</script>";
                } else {
                    echo "<script>alert('Error updating password')</script>";
                }
            } else {
                echo "<script>alert('No email or username was found')</script>";
            }
        }
    }
?>