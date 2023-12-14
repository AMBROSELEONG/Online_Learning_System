<?php
include '../../ConnectDB.php';
$id = "";
$name = "";
$price = "";
$type = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $QuizImage = $_POST['QuizImage'];
    $QuizName = $_POST['QuizName'];
    $CategoryID = $_POST['CategoryID'];
    $CategoryName = $_POST['CategoryName'];

    do {
        if (empty($QuizImage) || empty($QuizName) || empty($CategoryID) || empty($CategoryName)) {
            $errorMessage = "All the fields are require";
            break;

        }
        $sql = "INSERT INTO quiz(QuizImage, QuizName, CategoryID, CategoryName) VALUES ('$QuizImage', '$QuizName',$CategoryID,'$CategoryName')";
        $result = $conn->query($sql);

        if (!$result) {
            $error = "Invalid query: " . $conn->error;
            break;
        }

        $QuizImage = "";
        $QuizName = "";
        $CategoryID = "";
        $CategoryName = "";
        $success = "Quiz Added Successfully";

        header("location: Quiz.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container ny-5">
        <h2>New Quiz</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Quiz Image</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" name="QuizImage" value="<?php echo $QuizImage; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Quiz Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="QuizName" value="<?php echo $QuizName; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="hidden" class="form-control" name="CategoryID" value="<?php echo $CategoryID; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Category Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="CategoryName" value="<?php echo $CategoryName; ?>">
                </div>
            </div>
            <?php
            if (!empty($successMessage)) {
                echo "
                                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                    <strong>$successMessage</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                        ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="Quiz.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>