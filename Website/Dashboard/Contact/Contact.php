<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form method="post">
            <div style="width: 100%; justify-content: space-between; margin: 1% 0; display: flex;">
                <div>
                    <input type="text" name="search" id="search" placeholder="Search CourseCategory">
                    <input type="submit" name="searchsub" id="searchsub" value="Search">
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ContactID</td>
                        <td>UserID</td>
                        <td>UserName</td>
                        <td>UserPhone</td>
                        <td>UserEmail</td>
                        <td>Message</td>
                        <td>Status</td>
                        <td>Operating</td>
                    </tr>
                </thead>
                <tbody>
                   <?php
                    //include the connection to the database
                    include '../../ConnectDB.php';

                    //create a sql query to select all data from the contact table
                    $sql = "SELECT * FROM contact";
                    //execute the query and store the result in a variable
                    $result = $conn->query($sql);

                    //if the query fails, print an error message
                    if (!$result) {
                        die("Invalid query" . $conn->$error);
                    }

                    //loop through the result and echo the data into a table
                    while ($row = $result->fetch_assoc()) {
                        echo " <tr>
                                    <td>$row[ContactID]</td>
                                    <td>$row[UserID]</td>
                                    <td>$row[UserName]</td>
                                    <td>$row[ContactNumber]</td>
                                    <td>$row[Email]</td>
                                    <td>$row[Message]</td>
                                    <td>$row[ReplyStatus]</td>
                                    <td>
                                        <a href='reply.php?ContactID=$row[ContactID]' class='btn btn-danger btn-sm'>Reply</a>
                                    </td>
                                </tr>";
                    }
                    ?>

                </tbody>

            </table>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>