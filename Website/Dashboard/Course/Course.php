<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <div style="width: 100%; justify-content: space-between; margin: 1% 0; display: flex;">
                <a class="btn btn-primary" href="course-add.php" role="button">New Course</a>
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
                    <td>Course Image</td>
                    <td>Course Name</td>
                    <td>Course Price</td>
                    <td>Category Name</td>
                    <td>Operating</td>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../../ConnectDB.php';

                if (isset($_GET['search'])) {
                    $filterValue = $_GET['search'];
                    $query = "SELECT * FROM course WHERE CourseID LIKE '%$filterValue%' OR CourseName LIKE '%$filterValue%' OR CoursePrice LIKE '%$filterValue%' OR CategoryName LIKE '%$filterValue%'";
                    $result = $conn->query($query);

                    if (!$result) {
                        die("Invalid query" . $conn->error);
                    }

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                        <td>{$row['CourseID']}</td>
                                        <td>{$row['CourseImage']}</td>
                                        <td>{$row['CourseName']}</td>
                                        <td>{$row['CoursePrice']}</td>
                                        <td>{$row['CategoryName']}</td>
                                        <td>
                                            <a href='course-edit.php?CourseID={$row['CourseID']}' class='btn btn-primary btn-sm'>Edit</a>
                                            <a href='course-delete.php?CourseID={$row['CourseID']}' class='btn btn-danger btn-sm'>Delete</a>
                                        </td>
                                    </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No Record Found</td></tr>";
                    }
                } else {
                    $sql = "SELECT * FROM course";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query" . $conn->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                    <td>{$row['CourseID']}</td>
                                    <td>{$row['CourseImage']}</td>
                                    <td>{$row['CourseName']}</td>
                                    <td>{$row['CoursePrice']}</td>
                                    <td>{$row['CategoryName']}</td>
                                    <td>
                                        <a href='course-edit.php?CourseID={$row['CourseID']}' class='btn btn-primary btn-sm'>Edit</a>
                                        <a href='course-delete.php?CourseID={$row['CourseID']}' class='btn btn-danger btn-sm'>Delete</a>
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