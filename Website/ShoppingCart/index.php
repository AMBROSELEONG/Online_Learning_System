<?php
include '../ConnectDB.php';
include '../Session.php';
$_SESSION['previous_page'] = $_SERVER['HTTP_REFERER'];
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['CourseID'])) {
        header('Location: ' . $_SESSION['previous_page']);
        exit;
    }

    if (isset($_SESSION['UserID'])) {
        $UserId = $_SESSION['UserID'];
        $CourseID = $_GET['CourseID'];
        $sqlfindproduct = "SELECT CourseName, CategoryName, CoursePrice FROM course WHERE CourseID = '$CourseID'";
        $result = $conn->query($sqlfindproduct);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $CourseName = $row['CourseName'];
            $CategoryName = $row['CategoryName'];
            $CoursePrice = $row['CoursePrice'];

            $sql = "INSERT INTO shoppingcart (UserID, CourseID, CourseName, CategoryName, CoursePrice) VALUES ('$UserId', '$CourseID', '$CourseName', '$CategoryName', '$CoursePrice')";
            $result = $conn->query($sql);

            if ($result === TRUE) {
                $_SESSION['cart_message'] = 'Item added to cart successfully.';
                header('Location: ' . $_SESSION['previous_page']);
                exit;
            } else {
                echo "Error: " . $conn->error;
            }

        }
    } else {
        echo "Error: " . $conn->error;
    }
}

?>