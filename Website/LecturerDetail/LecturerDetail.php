<?php
include '../ConnectDB.php';

$LecturerID = $_GET['LecturerID'];

$sql = "SELECT * FROM lecturerdetail WHERE LecturerID = '$LecturerID'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Invalid Query" . $conn->error);
}

$row = mysqli_fetch_array($result);

$sqlImage = "SELECT * FROM lecturer WHERE LecturerID = '$LecturerID'";
$resultImage = mysqli_query($conn, $sqlImage);

if (!$resultImage) {
    die("Invalid Query" . $conn->error);
}

$rowImage = mysqli_fetch_array($resultImage);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo "{$row['LecturerName']}" ?>
    </title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background: #f7f7ff;
            margin-top: 20px;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid transparent;
            border-radius: .25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
        }

        .me-2 {
            margin-right: .5rem !important;
        }
    </style>
</head>

<body>
    <header class="headerpage mb-4"></header>
    <?php if ($row) { ?>
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <?php
                                    $imageFolder = '../Dashboard/Lecturer/';
                                    $imagePath = $imageFolder . $rowImage['LecturerImage'];
                                    echo "
                                    <img src='$imagePath' alt='Lecturer'
                                        class='rounded-circle p-1 bg-primary' width='110'>";

                                    ?>
                                    <div class="mt-3">
                                        <h4>
                                            <?php echo "{$row['LecturerName']}" ?>
                                        </h4>
                                        <p class="text-secondary mb-1">
                                            <?php echo "{$row['Professional']}" ?>
                                        </p>
                                        <p class="text-muted font-size-sm">
                                            <?php echo "{$row['Country']}" ?>
                                        </p>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-github me-2 icon-inline">
                                                <path
                                                    d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                                </path>
                                            </svg>Github</h6>
                                        <span class="text-secondary">
                                            <?php echo "{$row['Github']}" ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-twitter me-2 icon-inline text-info">
                                                <path
                                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                                </path>
                                            </svg>Twitter</h6>
                                        <span class="text-secondary">
                                            <?php echo "{$row['Twitter']}" ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-instagram me-2 icon-inline text-danger">
                                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                            </svg>Instagram</h6>
                                        <span class="text-secondary">
                                            <?php echo "{$row['Instagram']}" ?>
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-facebook me-2 icon-inline text-primary">
                                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                                </path>
                                            </svg>Facebook</h6>
                                        <span class="text-secondary">
                                            <?php echo "{$row['Facebook']}" ?>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <h6 class="mb-0">
                                            <?php echo "{$row['LecturerName']}" ?>
                                        </h6>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <h6 class="mb-0">
                                            <?php echo "{$row['LecturerEmail']}" ?>
                                        </h6>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <h6 class="mb-0">
                                            <?php echo "{$row['Phone']}" ?>
                                        </h6>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Teaching Subject</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <h6 class="mb-0">
                                            <?php echo "{$row['CourseName']}" ?>
                                        </h6>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Qualification</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <h6 class="mb-0">
                                            <?php echo "{$row['LecturerQualification']}" ?>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h1>Introduction</h1>
                                        <p>
                                            <?php echo "{$row['Introduction']}" ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footerpage"></footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <?php } ?>
    <script>
        $(function () {
            $(".headerpage").load("../Header.html");
            $(".footerpage").load("../Footer.html");
        });
    </script>
</body>

</html>