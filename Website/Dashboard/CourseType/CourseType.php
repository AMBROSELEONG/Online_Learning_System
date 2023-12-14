<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Type</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <div style="width: 100%; justify-content: space-between; margin: 1% 0; display: flex;">
                <a class="btn btn-primary" href="coursetype-add.php" role="button">New Category</a>
                <div>
                    <input type="text" name="search" id="search" placeholder="Search Course Category"
                        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <input type="submit" name="searchsub" id="searchsub" value="Search">
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <td>CategoryID</td>
                    <td>CategoryName</td>
                    <td>Operating</td>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../../ConnectDB.php';

                // Check if the search parameter is set
                if (isset($_GET['search'])) {
                    // Get the filter value from the URL
                    $filterValue = $_GET['search'];
                    // Create a query to search for the filter value in the CategoryID and CategoryName columns
                    $query = "SELECT * FROM coursecategory WHERE CategoryID LIKE '%$filterValue%' OR CategoryName LIKE '%$filterValue%'";
                    // Execute the query
                    $result = $conn->query($query);

                    // Check if the query was successful
                    if (!$result) {
                        // If not, print an error message
                        die("Invalid query" . $conn->error);
                    }

                    // Check if there are any results
                    if ($result->num_rows > 0) {
                        // If yes, loop through the results and print them
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                        <td>{$row['CategoryID']}</td>
                                        <td>{$row['CategoryName']}</td>
                                        <td>
                                            <a href='coursetype-edit.php?CategoryID={$row['CategoryID']}' class='btn btn-primary btn-sm'>Edit</a>
                                            <a href='coursetype-delete.php?CategoryID={$row['CategoryID']}' class='btn btn-danger btn-sm'>Delete</a>
                                        </td>
                                    </tr>";
                        }
                    } else {
                        // If no, print a message
                        echo "<tr><td colspan='3'>No Record Found</td></tr>";
                    }
                } else {
                    // If the search parameter is not set, execute the following query
                    $sql = "SELECT * FROM coursecategory";
                    $result = $conn->query($sql);

                    // Check if the query was successful
                    if (!$result) {
                        // If not, print an error message
                        die("Invalid query" . $conn->error);
                    }

                    // Check if there are any results
                    while ($row = $result->fetch_assoc()) {
                        // If yes, print them
                        echo "<tr>
                                    <td>{$row['CategoryID']}</td>
                                    <td>{$row['CategoryName']}</td>
                                    <td>
                                        <a href='coursetype-edit.php?CategoryID={$row['CategoryID']}' class='btn btn-primary btn-sm'>Edit</a>
                                        <a href='coursetype-delete.php?CategoryID={$row['CategoryID']}' class='btn btn-danger btn-sm'>Delete</a>
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