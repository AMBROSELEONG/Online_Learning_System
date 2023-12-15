<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lecturer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" name="indexf">
            <div style="width: 100%; justify-content: space-between; margin: 1% 0; display: flex;">
                <a class="btn btn-primary" href="Lecturer-add.php" role="button">New Lecturer</a>
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
                    <td>Lecturer Image</td>
                    <td>Lecturer Name</td>
                    <td>Lecturer Qualification</td>
                    <td>Operating</td>
                </tr>
            </thead>
            <tbody>
               <?php
                //include the connection to the database
                include '../../ConnectDB.php';

                //check if the search parameter is set
                if (isset($_GET['search'])) {
                    //store the value of the search parameter in a variable
                    $filterValue = $_GET['search'];
                    //create a query to search for the value of the filter
                    $query = "SELECT * FROM lecturer WHERE LecturerID LIKE '%$filterValue%' OR LecturerName LIKE '%$filterValue%'";
                    //execute the query
                    $result = $conn->query($query);

                    //check if the query was successful
                    if (!$result) {
                        //if not, print an error message
                        die("Invalid query" . $conn->error);
                    }

                    //check if the query returned any results
                    if ($result->num_rows > 0) {
                        //if yes, loop through the results
                        while ($row = $result->fetch_assoc()) {
                            //print the results in a table row
                            echo "<tr>
                                        <td>{$row['LecturerID']}</td>
                                        <td>{$row['LecturerImage']}</td>
                                        <td>{$row['LecturerName']}</td>
                                        <td>{$row['LecturerQualification']}</td>
                                        <td>
                                            <a href='Lecturer-edit.php?LecturerID={$row['LecturerID']}' class='btn btn-primary btn-sm'>Edit</a>
                                            <a href='Lecturer-delete.php?LecturerID={$row['LecturerID']}' class='btn btn-danger btn-sm'>Delete</a>
                                        </td>
                                    </tr>";
                        }
                    } else {
                        //if no, print a message
                        echo "<tr><td colspan='7'>No Record Found</td></tr>";
                    }
                } else {
                    //if the search parameter is not set, execute the following query
                    $sql = "SELECT * FROM lecturer";
                    $result = $conn->query($sql);

                    //check if the query was successful
                    if (!$result) {
                        //if not, print an error message
                        die("Invalid query" . $conn->error);
                    }

                    //check if the query returned any results
                    while ($row = $result->fetch_assoc()) {
                        //print the results in a table row
                        echo "<tr>
                                    <td>{$row['LecturerID']}</td>
                                    <td>{$row['LecturerImage']}</td>
                                    <td>{$row['LecturerName']}</td>
                                    <td>{$row['LecturerQualification']}</td>
                                    <td>
                                        <a href='Lecturer-edit.php?LecturerID={$row['LecturerID']}' class='btn btn-primary btn-sm'>Edit</a>
                                        <a href='Lecturer-delete.php?LecturerID={$row['LecturerID']}' class='btn btn-danger btn-sm'>Delete</a>
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