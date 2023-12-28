<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Purchase History</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <link rel="stylesheet" type="text/css" href="UserHistory.css">
</head>

<body>
    <div class="container-upper">
        <div class="container-right">
            <button onclick="window.location.href='../UserProfile/UserProfile.php'"
                script="window.location.replace('../UserProfile/UserProfile.php')">Profile</button>
            <button onclick="window.location.href='../UserResume/UserResume.php'"
                script="window.location.replace('../UserResume/UserResume.php')">Resume</button>
            <button>History</button>
        </div>
    </div>
    <div class="container-lower">
        <div class="container-content">
            <h1>Purchase History</h1>
            <h2 style="font-weight: normal;">Manage your recent orders & invoices</h2>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Course Name</th>
                    <th>Course Price</th>
                    <th>Order Date</th>
                </tr>
                <tbody>
                    <?php
                    include '../Session.php';
                    include '../ConnectDB.php';

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

</body>

</html>