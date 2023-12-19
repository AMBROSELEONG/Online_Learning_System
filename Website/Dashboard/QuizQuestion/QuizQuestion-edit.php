<?php
//include the connection to the database
include '../../ConnectDB.php';
//declare variables to store the course image, name, price, category id and category name
$QuizID = "";
$QuestionID = "";
$QuestionText = "";
$option1 = "";
$option2 = "";
$option3 = "";
$answers = "";

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
    $id = $_GET['QuizID'];

    //query the database to get the course information
    $sql = "SELECT * FROM quizquestion WHERE QuizID = '$id'";
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

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // Use elseif here instead of else
    //store the course information in the corresponding variables
    $QuizID = $_GET['QuizID'];
    $QuestionText = $_POST['QuestionText'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $answers = $_POST['answers'];

    do {
        //check if any of the course information is empty
        if (empty($QuizID) || empty($QuestionText) || empty($option1) || empty($option2) || empty($option3) || empty($answers)) {
            //if any of the course information is empty, store an error message in the error variable
            $error = "Please fill in all fields";
            break;
        }
        //update the course information in the database
        $sqlQuizDetail = "UPDATE quizquestion SET QuestionText = '$QuestionText' , option1 = '$option1' , option2 = '$option2' , option3 = '$option3' , answers = '$answers' WHERE QuizID = '$QuizID'";

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
                <label class="col-sm-3 col-form-label">Question Text</label>
                <div class="col-sm-6">
                    <input type="textarea" class="form-control" name="QuestionText" value="<?php echo $QuestionText; ?>">
                        <?php
                        //Create a query to select all the categories from the coursecategory table
                        $query1 = "SELECT * FROM quizquestion";
                        //Execute the query and store the result in the $result1 variable
                        $result1 = mysqli_query($conn, $query1);

                        if($result1){
                            while($row = mysqli_fetch_assoc($result1)){
                                $QuestionText = $row['QuestionText'];
                                echo "<option value='$QuestionText'</option>";
                            }
                        }

                        ?>
                    
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Option 1</label>
                        <div class="col-sm-6">
                            <input type="textarea" class="form-control" name="option1" value="<?php echo $option1; ?>">
                                <?php
                                    $query2 = "SELECT * FROM quizquestion";

                                    $result2 = mysqli_query($conn, $query2);

                                    if($result2){
                                        while($row = mysqli_fetch_assoc($result2)){
                                            $option1 = $row['option1'];
                                            echo "<option value='$option1'</option>";
                                        }
                                    }
                                ?>
                        </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Option 2</label>
                        <div class="col-sm-6">
                            <input type="textarea" class="form-control" name="option2" value="<?php echo $option2; ?>">
                                <?php
                                        $query3 = "SELECT * FROM quizquestion";

                                        $result3 = mysqli_query($conn, $query3);

                                        if($result3){
                                            while($row = mysqli_fetch_assoc($result3)){
                                                $option2 = $row['option2'];
                                                echo "<option value='$option2'</option>";
                                            }
                                        }
                                    ?>                            
                        </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Option 3</label>
                        <div class="col-sm-6">
                            <input type="textarea" class="form-control" name="option3" value="<?php echo $option3; ?>">
                                <?php
                                        $query4 = "SELECT * FROM quizquestion";

                                        $result4 = mysqli_query($conn, $query4);

                                        if($result4){
                                            while($row = mysqli_fetch_assoc($result4)){
                                                $option3 = $row['option3'];
                                                echo "<option value='$option3'</option>";
                                            }
                                        }
                                    ?>                
                        </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Answers</label>
                        <div class="col-sm-6">
                            <input type="textarea" class="form-control" name="answers" value="<?php echo $answers; ?>">
                                <?php
                                        $query5 = "SELECT * FROM quizquestion";

                                        $result5 = mysqli_query($conn, $query5);

                                        if($result5){
                                            while($row = mysqli_fetch_assoc($result2)){
                                                $answers = $row['answers'];
                                                echo "<option value='$answers'</option>";
                                            }
                                        }
                                    ?>               
                        </div>
                </div>

            <script>
                //This code is used to select an option from the dropdown menu and display the selected option in the textbox
                document.getElementById('QuizID').addEventListener('change', function () {
                    //Get the selected index of the dropdown menu
                    var selectedIndex = this.selectedIndex;
                    //Get the selected option from the dropdown menu
                    var selectedOption = this.options[selectedIndex];
                    //Get the text of the selected option
                    var categoryName = selectedOption.text;

                    //Display the selected option in the textbox
                    document.getElementById('QuizName').value = quizName;
                });
            </script>

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