<?php
include "../ConnectDB.php";
include "../Session.php";
$userID = $_SESSION['UserID'];
$sql = "SELECT * FROM shoppingcart WHERE UserID = '$userID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $createOrderQuery = "INSERT INTO orders (UserID, CartID, CourseID, CourseName, CoursePrice, OrderDate) VALUES ";

    while ($row = $result->fetch_assoc()) {
        $CartID = $row['CartID'];
        $CourseID = $row['CourseID'];
        $CourseName = $row['CourseName'];
        $CoursePrice = $row['CoursePrice'];

        $createOrderQuery .= "('$userID','$CartID','$CourseID','$CourseName','$CoursePrice', CURDATE()),";
        $CartIDs[] = $CartID;
    }

    $createOrderQuery = rtrim($createOrderQuery, ",");

    if ($conn->query($createOrderQuery) === TRUE) {
        $clearCartQuery = "DELETE FROM shoppingcart WHERE UserID = '$userID'";
        $conn->query($clearCartQuery);
        $cartIDString = implode(',', $CartIDs);
        echo "<script type='text/javascript'>
        setTimeout(function () {
            window.location.href = 'Receipt.php?cartIDs=$cartIDString';
        }, 5000);
    </script>";
    }
} else {
    echo "No items in the shopping cart.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .buttonload {
            background-color: transparent;
            border: none;
            color: black;
            padding: 12px 16px;
            font-size: 100px;
        }
    </style>
</head>

<body>
    <button class="buttonload">
        <i class="fa fa-spinner fa-spin"></i>
    </button>
</body>

</html>