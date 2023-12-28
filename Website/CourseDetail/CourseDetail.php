<?php
include "../ConnectDB.php";

$courseID = $_GET['CourseID'];
$sql = "SELECT * FROM coursedetail WHERE CourseID = $courseID";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Invalid Query" . $conn->error);
}

$row = mysqli_fetch_assoc($result);

// At the beginning of the page or wherever you want to display the message
session_start();

// Check if the success message exists and display it
if (isset($_SESSION['cart_message'])) {
    echo "<script type='text/javascript'>alert('{$_SESSION['cart_message']}')</script>";
    unset($_SESSION['cart_message']); // Clear the message after displaying it
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="CourseDatail.css">
    <link rel="stylesheet" href="../icon/iconfont.css">
    <link rel="stylesheet" href="../icon2/iconfont.css">
    <title>
        <?php echo "{$row['CourseName']}" ?>
    </title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php if ($row) { ?>
        <div style="background-color: rgb(255, 140, 0);">
            <div class="container py-4">
                <nav class="d-flex">
                    <h6 class="mb-0">
                        <a href="../MainPage/MainPage.php" class="text-white-50">Home</a>
                        <span class="text-white-50 mx-2"> > </span>
                        <a href="../Course/CoursePage.php" class="text-white-50">Course</a>
                        <span class="text-white-50 mx-2"> > </span>
                        <a href="" class="text-white"><u>Course Detail</u></a>
                    </h6>
                </nav>
            </div>
        </div>
        <section class="py-5">
            <div class="container">
                <div class="row gx-5">
                    <aside class="col-lg-6">
                        <div class="border rounded-4 mb-3 d-flex justify-content-center">
                            <?php
                            $imageFolder = '../Dashboard/Course/';
                            $imagePath = $imageFolder . $row['CourseImage'];
                            echo "<img style='max-width: 100%; max-height: 100vh; margin: auto;' class='rounded-4 fit'
                                src='$imagePath' />";
                            ?>
                        </div>
                    </aside>
                    <main class="col-lg-6">
                        <div class="ps-lg-3">
                            <h1 class="title text-dark">
                                <?php echo "{$row['CourseName']}" ?>
                            </h1>
                            <div class="mb-3">
                                <span class="h5">
                                    <?php echo "RM {$row['CoursePrice']}" ?>
                                </span>
                            </div>
                            <p>
                                <?php echo "{$row['CourseDescription']}" ?>
                            </p>

                            <div class="row">
                                <dt class="col-3">Category:</dt>
                                <dd class="col-9">
                                    <?php echo "{$row['CategoryName']}" ?>
                                </dd>

                                <dt class="col-3">Lecturer</dt>
                                <dd class="col-9">
                                    <?php echo "{$row['LecturerName']}" ?>
                                </dd>

                                <dt class="col-3">Lecturer Qualifications</dt>
                                <dd class="col-9">
                                    <?php echo "{$row['LecturerQualification']} Years" ?>
                                </dd>

                                <dt class="col-3">Study Duration</dt>
                                <dd class="col-9">
                                    <?php echo "{$row['StudyDuration']} Years" ?>
                                </dd>

                                <dt class="col-3">Learning Platform</dt>
                                <dd class="col-9">
                                    <?php echo "{$row['LearningPlatform']}" ?>
                                </dd>
                            </div>

                            <hr />
                            <a class="btn btn-primary shadow-0"
                                href="../ShoppingCart/index.php?CourseID=<?php echo $row['CourseID']; ?>">
                                <i class="me-1 fa fa-shopping-basket"></i> Add to Cart
                            </a>
                        </div>
                    </main>
                    <div class="tab-content" id="ex1-content">
                        <h4 class="title text-dark">
                            Learning Result
                        </h4>
                        <div class="tab-pane fade show active" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                            <p>
                                <?php echo "{$row['LearningResult']}" ?>
                            </p>
                            <h4 class="title text-dark">
                                Course Outline
                            </h4>
                            <div class="row mb-2">
                                <div class="col-12 col-md-6">
                                    <?php echo "{$row['CourseOutline']}" ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <iframe src="../Footer.html" frameborder="0" width="100%" height="420px"></iframe>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <?php } ?>
</body>

</html>