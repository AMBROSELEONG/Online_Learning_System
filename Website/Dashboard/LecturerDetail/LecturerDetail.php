<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lecturer Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" name="indexf">
            <div style="width: 100%; justify-content: space-between; margin: 1% 0; display: flex;">
                <div>
                    <input type="text" name="search" id="search" placeholder="Search Lecturer"
                        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <input type="submit" name="searchsub" id="searchsub" value="Search">
                </div>
            </div>
        </form>
        <table class="table table-striped">
            <thead> 
                <tr>
                    <td>Lecturer ID</td>
                    <td>Lecturer Name</td>
                    <td>Lecturer Professional</td>
                    <td>Lecturer Qualification</td>
                    <td>Course Name</td>
                    <td>Lecturer Email</td>
                    <td>Operating</td>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../../ConnectDB.php';

                if (isset($_GET['search'])) {
                    $filterValue = $_GET['search'];
                    $query = "SELECT * FROM lecturerdetail WHERE LecturerID LIKE '%$filterValue%' OR LecturerName LIKE '%$filterValue%' OR Professional LIKE '%$filterValue%' OR LecturerQualification LIKE '%$filterValue%' OR CourseName LIKE '%$filterValue%' OR LecturerEmail LIKE '%$filterValue%'";
                    $result = $conn->query($query);

                    if (!$result) {
                        die("Invalid query" . $conn->error);
                    }

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                        <td>{$row['LecturerID']}</td>
                                        <td>{$row['LecturerName']}</td>
                                        <td>{$row['Professional']}</td>
                                        <td>{$row['LecturerQualification']}</td>
                                        <td>{$row['CourseName']}</td>
                                        <td>{$row['LecturerEmail']}</td>
                                        <td>
                                            <a href='detail-edit.php?LecturerID={$row['LecturerID']}' class='btn btn-primary btn-sm'>Edit</a>
                                        </td>
                                    </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No Record Found</td></tr>";
                    }
                } else {
                    $sql = "SELECT * FROM lecturerdetail";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query" . $conn->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                    <td>{$row['LecturerID']}</td>
                                    <td>{$row['LecturerName']}</td>
                                    <td>{$row['Professional']}</td>
                                    <td>{$row['LecturerQualification']}</td>
                                    <td>{$row['CourseName']}</td>
                                    <td>{$row['LecturerEmail']}</td>
                                    <td>
                                        <a href='detail-edit.php?LecturerID={$row['LecturerID']}' class='btn btn-primary btn-sm'>Edit</a>
                                    </td>
                                </tr>";
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
    <script type="text/javascript">

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>