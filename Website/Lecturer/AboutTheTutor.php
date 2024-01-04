<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About The Tutor</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <link rel="stylesheet" type="text/css" href="course.css">
    <link rel="stylesheet" href="../icon/iconfont.css">
    <link rel="stylesheet" href="../icon2/iconfont.css">
    <link rel="stylesheet" href="../Dashboard/icon2/iconfont.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body style="background-color: #f0f0f0;">
    <header class="headerpage"></header>
    <div class="container-fluid mt-5 mb-5">
        <div class="col">
            <div class="row g-2">
                <?php
                include "../ConnectDB.php";
                $sql = "SELECT * FROM lecturer";
                $result = mysqli_query($conn, $sql);

                if (!$result) {
                    die("Invalid Query" . $conn->error);
                }

                while ($row = $result->fetch_assoc()) {
                    $imageFolder = '../Dashboard/Lecturer/';
                    $imagePath = $imageFolder . $row['LecturerImage'];

                    echo "<div class='col-md-3 product-card' onclick=\"window.location.href='../LecturerDetail/LecturerDetail.php?LecturerID={$row['LecturerID']}'\">
                            <div class='product py-4 m-2 bg-light'>
                                <div class='text-center'>
                                    <img src='$imagePath' width='200' alt='Lecturer'>
                                </div>
                                <div class='about text-center'>
                                    <h5>Lecturer Name: {$row['LecturerName']}</h5>
                                    <h6>Teaching Subject: {$row['CourseName']}</h6>
                                    <span>Qualification: {$row['LecturerQualification']} Years</span>
                                </div>
                            </div>
                        </div>";
                }
                ?>
            </div>
        </div>
    </div>
    </div>
    <div class="joinour d-flex flex-column align-items-center bg-light p-4 mt-4">
        <p class="mb-2" style="font-size: 3rem; color: #6a6f73;">Join Our team now</p>
        <button class="btn btn-outline-warning" onclick="window.location.href = '../ContactUs/ContactUs.php'">Explore
            Jobs</button>
    </div>
    <footer class="footerpage"></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        $(function () {
            $(".headerpage").load("../Header.html");
            $(".footerpage").load("../Footer.html");
        });
    </script>

</body>

</html>