<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form action="" method="post" name="indexf">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>OrderID</td>
                        <td>UserID</td>
                        <td>CourseName</td>
                        <td>Price</td>
                        <td>OrderDate</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../ConnectDB.php';

                    $sql = "SELECT * FROM orders";

                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query" . $conn->$error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "  <tr>
                                    <td>$row[OrderID]</td>
                                    <td>$row[UserID]</td>
                                    <td>$row[CourseName]</td>
                                    <td>$row[CoursePrice]</td>
                                    <td>$row[OrderDate]</td>
                                </tr>";
                    }
                    ?>

                </tbody>
            </table>
        </form>
    </div>
    <script type="text/javascript">

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>