<?php
//include the ConnectDB.php file to connect to the database
include '../ConnectDB.php';
//include the index.php file
include 'index.php';

//create a SQL query to select all comments from the comments table and order them by PostDate in descending order
$sql = "SELECT * FROM comments ORDER BY PostDate DESC";
//execute the query and store the result in the $result variable
$result = $conn->query($sql);

function getUsernameFromUserID($conn, $userID)
{

    //escape the userID to prevent SQL injection
    $userID = mysqli_real_escape_string($conn, $userID);

    //create a SQL query to select the username from the users table where the userID matches the one passed in
    $query = "SELECT UserName FROM users WHERE UserID = '$userID'";
    //execute the query and store the result in the $result variable
    $result = mysqli_query($conn, $query);

    //check if the query was successful and if there is a result
    if ($result && mysqli_num_rows($result) > 0) {
        //fetch the result from the query and store it in the $row variable
        $row = mysqli_fetch_assoc($result);
        //return the username from the $row variable
        return $row['UserName'];
    } else {
        //return an empty string if the query was not successful or there is no result
        return '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Board</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        .comment-box {
            margin-top: 20px;
        }
    </style>
</head>

<body style="background-image: url(../img/comment.jpg);">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(60, 60, 60); padding: 1% 4%;">
        <div class="container">
            <a class="navbar-brand" href="../MainPage/MainPage.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../Course/CoursePage.php" style="font-size: 20px;">Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Quiz/QuizList.php" style="font-size: 20px;">Quiz</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../ContactUs/ContactUs.php" style="font-size: 20px;">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script>
        // Wait for the document to be loaded before running the code
        document.addEventListener("DOMContentLoaded", function () {
            // Select the toggler and the navbar-collapse
            var navbarToggler = document.querySelector(".navbar-toggler");
            var navbarCollapse = document.querySelector(".navbar-collapse");

            // Add an event listener to the toggler that will toggle the navbar-collapse when clicked
            navbarToggler.addEventListener("click", function () {
                navbarCollapse.classList.toggle("show");
            });
        });
    </script>

    <div class="container">
        <h1 class="mt-5">Comment Board</h1>

        <div class="comment-box">
            <form id="commentForm" action="index.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required
                        value="<?php echo getUsernameFromUserID($conn, $_SESSION['UserID']); ?>">
                </div>
                <div class="mb-3">
                    <label for="course" class="form-label">Course:</label>
                    <textarea class="form-control" id="course" name="course" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Content:</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Publish</button>
            </form>
        </div>
        <div class="comment-box mt-4">
            <h3>Comment List</h3>
            <ul id="commentList" class="list-group">
                <?php
                // Check if there are any comments
                if ($result->num_rows > 0) {
                    // Loop through the comments
                    while ($row = $result->fetch_assoc()) {
                        // Print each comment
                        echo '<li class="list-group-item">
                    <strong>' . htmlspecialchars($row['UserName']) . ':</strong><br>' . htmlspecialchars($row['Content']) . '<br>' . htmlspecialchars($row['CourseName']) . '<br>';
                    }
                } else {
                    // Print a message if there are no comments
                    echo "No comments yet.";
                }

                // Close the connection
                $conn->close();
                ?>
            </ul>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            // Function to get the current time
            function getCurrentTime() {
                // Create a new Date object
                var currentDate = new Date();
                // Get the day, month, and year
                var day = currentDate.getDate();
                var month = currentDate.getMonth() + 1; // Month starts from 0
                var year = currentDate.getFullYear();
                // Get the hours, minutes, and seconds
                var hours = currentDate.getHours();
                var minutes = currentDate.getMinutes();
                var seconds = currentDate.getSeconds();

                // Create a formatted string with the current time
                var formattedTime = year + '-' + addZeroBefore(month) + '-' + addZeroBefore(day) + ' ' + addZeroBefore(hours) + ':' + addZeroBefore(minutes) + ':' + addZeroBefore(seconds);
                // Return the formatted string
                return formattedTime;
            }

            // Function to add a zero before a single digit
            function addZeroBefore(number) {
                // Return a zero if the number is less than 10, otherwise return the number
                return (number < 10 ? '0' : '') + number;
            }

            // Add an event listener to the form submit button
            document.getElementById('commentForm').addEventListener('submit', function (event) {
                // Prevent the default action of the form submit
                event.preventDefault();

                // Get the values from the form
                var name = document.getElementById('name').value;
                var comment = document.getElementById('comment').value;
                var course = document.getElementById('course').value;
                var currentTime = getCurrentTime();

                // Create a new FormData object
                var formData = new FormData(this);

                // Create a new list item
                var li = document.createElement('li');
                li.className = 'list-group-item';
                li.innerHTML = '<strong>' + name + ':</strong><br> ' + comment + "<br>" + course + '<br>' + '<small>Posted on ' + currentTime + '</small>';

                // Append the list item to the list
                document.getElementById('commentList').appendChild(li);

                // Clear the form
                document.getElementById('name').value = '';
                document.getElementById('comment').value = '';
                document.getElementById('course').value = '';

                // Send the form data to the server
                fetch('index.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.text())
                    .then(data => {
                        // Handle the server response here if needed
                        console.log(data);
                    })
                    .catch(error => {
                        // Handle any errors
                        console.error('Error:', error);
                    });
            });
        </script>
</body>

</html>