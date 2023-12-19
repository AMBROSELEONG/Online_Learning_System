<?php
//include the Session.php file to start the session
include '../Session.php';
//create an empty array to store any errors
$errors = [];
//check if the request method is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //store the values of the form in the variables
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $course = $_POST['course'];
    //store the current date and time in the variable
    $post_time = date('Y-m-d H:i:s');

    //include the ConnectDB.php file to connect to the database
    include '../ConnectDB.php';
    //prepare the statement to insert the data into the database
    $stmt = $conn->prepare("INSERT INTO comments (UserID, UserName, CourseName, Content, PostDate) VALUES (?,?,?,?,?)");
    //bind the parameters to the statement
    $stmt->bind_param("issss", $userID, $name, $course, $comment, $post_time);

    //execute the statement
    if ($stmt->execute()) {
        //if the statement executed successfully, display a success message
        echo "Comment added successfully!";
    } else {
        //if the statement executed unsuccessfully, display an error message
        echo "Error: " . $stmt->error;
    }

    //select all the comments from the database and order them by post date
    $sql = "SELECT * FROM comments ORDER BY PostDate DESC";
    //execute the statement
    $result = $conn->query($sql);

    // Output each comment
    //output each comment
    if ($result->num_rows > 0) {
        //if there are comments, output them in a list
        echo '<ul id="commentList" class="list-group">';
        while ($row = $result->fetch_assoc()) {
            //output each comment in the list
            echo '<li class="list-group-item"><strong>' . htmlspecialchars($row['UserName']) . ':</strong><br>' . htmlspecialchars($row['CourseName']) . '<br>' . htmlspecialchars($row['Content']) . '<br><small>Posted on ' . htmlspecialchars($row['PostDate']) . '</small></li>';
        }
        echo '</ul>';
        header("location: Comment.php");
        exit();
    } else {
        //if there are no comments, display a message
        echo "No comments yet.";
    }

    //close the statement
    $stmt->close();
    //close the connection
    $conn->close();
} else {
    //if the request method is not a POST request, check for any errors
    foreach ($errors as $error) {
        //if there are errors, display them
        echo $error . "<br>";
    }
}
?>