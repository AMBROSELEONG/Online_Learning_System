<?php
//include the connection to the database
include '../../ConnectDB.php';
//declare variables to store the course image, name, price, category id and category name
$QuizID = "";
$QuestionID = "";
$QuestionOne = "";
$OptOne1 = "";
$OptOne2 = "";
$OptOne3 = "";
$AnsOne = "";
$QuestionTwo = "";
$OptTwo1 = "";
$OptTwo2 = "";
$OptTwo3 = "";
$AnsTwo = "";
$QuestionThree = "";
$OptThree1 = "";
$OptThree2 = "";
$OptThree3 = "";
$AnsThree = "";
$QuestionFour = "";
$OptFour1 = "";
$OptFour2 = "";
$OptFour3 = "";
$AnsFour = "";
$error = "";
$success = "";

//check if the request method is a GET request
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //check if the course id is set
    if (!isset($_GET['QuizID'])) {
        //if the course id is not set, redirect to the course page
        header("Location: QuizQuestion.php");
        exit;
    }

    //store the course id in the id variable
    $QuizID = $_GET['QuizID'];

    //query the database to get the course information
    $sql = "SELECT * FROM quizquestion WHERE QuizID = '$QuizID'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    //check if the course information is returned
    if (!$row) {
        //if the course information is not returned, redirect to the course page
        header("Location: QuizQuestion.php");
        exit;
    }

    //store the course information in the corresponding variables
    $QuizID = $row['QuizID'];
    $QuestionOne = $row['QuestionOne'];
    $OptOne1 = $row['OptOne1'];
    $OptOne2 = $row['OptOne2'];
    $OptOne3 = $row['OptOne3'];
    $AnsOne = $row['AnsOne'];
    $QuestionTwo = $row['QuestionTwo'];
    $OptTwo1 = $row['OptTwo1'];
    $OptTwo2 = $row['OptTwo2'];
    $OptTwo3 = $row['OptTwo3'];
    $AnsTwo = $row['AnsTwo'];
    $QuestionThree = $row['QuestionThree'];
    $OptThree1 = $row['OptThree1'];
    $OptThree2 = $row['OptThree2'];
    $OptThree3 = $row['OptThree3'];
    $AnsThree = $row['AnsThree'];
    $QuestionFour = $row['QuestionFour'];
    $OptFour1 = $row['OptFour1'];
    $OptFour2 = $row['OptFour2'];
    $OptFour3 = $row['OptFour3'];
    $AnsFour = $row['AnsFour'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // Use elseif here instead of else
    //store the course information in the corresponding variables
    $QuizID = $_GET['QuizID'];
    $QuestionOne = $_POST['QuestionOne'];
    $OptOne1 = $_POST['OptOne1'];
    $OptOne2 = $_POST['OptOne2'];
    $OptOne3 = $_POST['OptOne3'];
    $AnsOne = $_POST['AnsOne'];
    $QuestionTwo = $_POST['QuestionTwo'];
    $OptTwo1 = $_POST['OptTwo1'];
    $OptTwo2 = $_POST['OptTwo2'];
    $OptTwo3 = $_POST['OptTwo3'];
    $AnsTwo = $_POST['AnsTwo'];
    $QuestionThree = $_POST['QuestionThree'];
    $OptThree1 = $_POST['OptThree1'];
    $OptThree2 = $_POST['OptThree2'];
    $OptThree3 = $_POST['OptThree3'];
    $AnsThree = $_POST['AnsThree'];
    $QuestionFour = $_POST['QuestionFour'];
    $OptFour1 = $_POST['OptFour1'];
    $OptFour2 = $_POST['OptFour2'];
    $OptFour3 = $_POST['OptFour3'];
    $AnsFour = $_POST['AnsFour'];

    do {
        //check if any of the course information is empty
        if (empty($QuestionOne) || empty($OptOne1) || empty($OptOne2) || empty($OptOne3) || empty($AnsOne) || empty($QuestionTwo) || empty($OptTwo1) || empty($OptTwo2) || empty($OptTwo3) || empty($AnsTwo) || empty($QuestionThree) || empty($OptThree1) || empty($OptThree2) || empty($OptThree3) || empty($AnsThree) || empty($QuestionFour) || empty($OptFour1) || empty($OptFour2) || empty($OptFour3) || empty($AnsFour)) {
            //if any of the course information is empty, store an error message in the error variable
            $error = "Please fill in all fields";
            break;
        }
        //update the course information in the database
        $sqlQuizDetail = "UPDATE quizquestion SET QuestionOne = '$QuestionOne' , OptOne1 = '$OptOne1' , OptOne2 = '$OptOne2' , OptOne3 = '$OptOne3' , AnsOne = '$AnsOne', QuestionTwo = '$QuestionTwo', OptTwo1 = '$OptTwo1', OptTwo2 = '$OptTwo2', OptTwo3 = '$OptTwo3', AnsTwo = '$AnsTwo', QuestionThree = '$QuestionThree', OptThree1 = '$OptThree1', OptThree2 = '$OptThree2', OptThree3 = '$OptThree3', AnsThree = '$AnsThree', QuestionFour = '$QuestionFour', OptFour1 = '$OptFour1', OptFour2 = '$OptFour2', OptFour3 = '$OptFour3', AnsFour = '$AnsFour'  WHERE QuizID = '$QuizID'";

        $resultQuizDetail = $conn->query($sqlQuizDetail);

        if (!$resultQuizDetail) {
            // Error updating course detail
            $error = "Error updating question detail: " . $conn->error;
        } else {
            $success = "Course Details updated successfully";
            header("location: QuizQuestion.php");
            exit;
        }
    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2>Add Question</h2>

        <form method="post" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="QuizID" value="<?php echo $QuizID; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Question One</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="QuestionOne"><?php echo $QuestionOne; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Option One</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="OptOne1"><?php echo $OptOne1; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Option Two</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="OptOne2"><?php echo $OptOne2; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Option Three</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="OptOne3"><?php echo $OptOne3; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Answer</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="AnsOne"><?php echo $AnsOne; ?></textarea>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Question Two</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="QuestionTwo"><?php echo $QuestionTwo; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Option One</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="OptTwo1"><?php echo $OptTwo1; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Option Two</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="OptTwo2"><?php echo $OptTwo2; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Option Three</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="OptTwo3"><?php echo $OptTwo3; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Answer</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="AnsTwo"><?php echo $AnsTwo; ?></textarea>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Question Three</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="QuestionThree"><?php echo $QuestionThree; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Option One</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="OptThree1"><?php echo $OptThree1; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Option Two</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="OptThree2"><?php echo $OptThree2; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Option Three</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="OptThree3"><?php echo $OptThree3; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Answer</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="AnsThree"><?php echo $AnsThree; ?></textarea>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Question Four</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="QuestionFour"><?php echo $QuestionFour; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Option One</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="OptFour1"><?php echo $OptFour1; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Option Two</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="OptFour2"><?php echo $OptFour2; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Option Three</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="OptFour3"><?php echo $OptFour3; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Answer</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="AnsFour"><?php echo $AnsFour; ?></textarea>
                </div>
            </div>
            <?php
            if (!empty($success)) {
                echo "
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$success</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }

            if (!empty($error)) {
                echo "
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$error</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="AddQuiz">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="QuizQuestion.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>