<?php
include '../Session.php';
include '../ConnectDB.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Purchase History</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <header class="headerpage"></header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="jumbotron">
                    <h1 class="display-4">Purchase History</h1>
                    <p class="lead">Manage your recent orders & invoices</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Course Name</th>
                                <th scope="col">Course Price</th>
                                <th scope="col">Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM orders WHERE UserID = '$userID'";

                            $result = $conn->query($sql);

                            if (!$result) {
                                die("Invalid query" . $conn->$error);
                            }

                            while ($row = $result->fetch_assoc()) {
                                echo "  <tr>
                                            <td>$row[OrderID]</td>
                                            <td>$row[CourseName]</td>
                                            <td>$row[CoursePrice]</td>
                                            <td>$row[OrderDate]</td>
                                        </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <footer class="footerpage"></footer>
    <script>
        $(function () {
            $(".headerpage").load("../Header.html");
            $(".footerpage").load("../Footer.html");
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>