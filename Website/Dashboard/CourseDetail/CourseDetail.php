<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <div style="width: 100%; justify-content: space-between; margin: 1% 0; display: flex;">
                <div>
                    <input type="text" name="search" id="search" placeholder="Search Course"
                        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <input type="submit" name="searchsub" id="searchsub" value="Search">
                </div>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>Course ID</td>
                    <td>Course Name</td>
                    <td>Course Description</td>
                    <td>Category Name</td>
                    <td>Lecturer Name</td>
                    <td>Operating</td>
                </tr>
            </thead>
            <tbody>
                <?php
                //include the connection to the database
                include '../../ConnectDB.php';

                //check if the search query is set
                if (isset($_GET['search'])) {
                    //store the value of the search query in a variable
                    $filterValue = $_GET['search'];
                    //create a query to search for the course based on the filter value
                    $query = "SELECT * FROM coursedetail WHERE CourseID LIKE '%$filterValue%' OR CourseName LIKE '%$filterValue%' OR CoursePrice LIKE '%$filterValue%' OR CourseDescription LIKE '%$filterValue%' OR CategoryName LIKE '%$filterValue%' OR LecturerName LIKE '%$filterValue%' OR LecturerQualification LIKE '%$filterValue%' OR StudyDuration LIKE '%$filterValue%' OR LearningPlatform LIKE '%$filterValue%' OR LearningResult LIKE '%$filterValue%' OR CourseOutline LIKE '%$filterValue%'";
                    //execute the query
                    $result = $conn->query($query);

                    //check if the query is valid
                    if (!$result) {
                        //if not, throw an error
                        die("Invalid query" . $conn->error);
                    }

                    //check if the query returns any results
                    if ($result->num_rows > 0) {
                        //if yes, loop through the results
                        while ($row = $result->fetch_assoc()) {
                            //echo the results in a table format
                            echo "<tr>
                                    <td>{$row['CourseID']}</td>
                                    <td>{$row['CourseName']}</td>
                                    <td>{$row['CourseDescription']}</td>
                                    <td>{$row['CategoryName']}</td>
                                    <td>{$row['LecturerName']}</td>
                                    <td>
                                        <a href='edit-detail.php?CourseID={$row['CourseID']}' class='btn btn-primary btn-sm'>Edit</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        //if no, echo a message
                        echo "<tr><td colspan='13'>No Record Found</td></tr>";
                    }
                } else {
                    //if the search query is not set, execute the following query
                    $sql = "SELECT * FROM coursedetail";
                    $result = $conn->query($sql);

                    //check if the query is valid
                    if (!$result) {
                        //if not, throw an error
                        die("Invalid query" . $conn->error);
                    }

                    //check if the query returns any results
                    while ($row = $result->fetch_assoc()) {
                        //echo the results in a table format
                        echo "<tr>
                                    <td>{$row['CourseID']}</td>
                                    <td>{$row['CourseName']}</td>
                                    <td>{$row['CourseDescription']}</td>
                                    <td>{$row['CategoryName']}</td>
                                    <td>{$row['LecturerName']}</td>
                                    <td>
                                        <a href='edit-detail.php?CourseID={$row['CourseID']}' class='btn btn-primary btn-sm'>Edit</a>
                                    </td>
                                </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>