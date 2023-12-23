<?php
// search.php

include "ConnectDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST['search'];

    $sql = "SELECT * FROM course WHERE CourseName LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Invalid Query" . $conn->error);
    }

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div onclick=\"window.location.href='CourseDetail/CourseDetail.php?CourseID={$row['CourseID']}'\">";
            echo "<h4>" . $row['CourseName'] . "</h4>";
            echo "<p>" . $row['CategoryName'] . "</p>";
            echo "</div>";
        }
    } else {
        echo "No courses found.";
    }

    mysqli_close($conn);
}
?>