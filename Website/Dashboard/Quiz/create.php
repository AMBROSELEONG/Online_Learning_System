<?php

include '../../ConnectDB.php';

$QuizImage = "";
$QuizName = "";
$CategoryID = "";
$CategoryName = "";

$error = "";
$success = "";

if (isset($_POST['AddQuiz'])) {

    $Filename = $_FILES['QuizImage']['name'];

    if (
        move_uploaded_file(
            $_FILES['QuizImage']['tmp_name'],
            "quiz-image/" . $Filename)
    ) {
        
        $QuizImage = "quiz-image/" . $Filename;

    } else {
        
        $error = "File could not be uploaded";
    }

    $QuizName = $_POST['QuizName'];
    $CategoryID = $_POST['CategoryID'];
    $CategoryName = $_POST['CategoryName'];

    //store the query to add the course in a variable
    $query = "INSERT INTO quiz(QuizImage, QuizName, CategoryID, CategoryName) VALUES ('$CourseImage', '$CourseName','$CategoryID','$CategoryName')";
    //execute the query to add the course
    $result = mysqli_query($conn, $query);
    //check if the query has been executed successfully
    if ($result) {
        //if the query has been executed successfully, store a success message in the success variable
        $success = "Quiz Added Successfully";
        header("location: Quiz.php");
    } else {
        //if the query has not been executed successfully, store an error message in the error variable
        $error = "Quiz Not Added" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class="container ny-5">
        <h2>New Client</h2>

        <form action="" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <input type="hidden" class="form-control" name="id" value="<?php echo $QuizImaged;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Quiz Image</label>
                     <div class="col-sm-6">
                            <input type="file" class="form-control" name="QuizImage">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Quiz Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="QuizName" value="<?php echo $QuizName;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">CategoryID</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="CategoryID" value="<?php echo $CategoryID;?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">CategoryName</label>
                    <div class="col-sm-6">
                    <select type="text" class="form-control" name="CategoryName">
                        <?php
                        $query1 = "SELECT CategoryID, CategoryName FROM quizcategory";
                        $result1 = mysqli_query($conn, $query1);

                        if ($result1) {
                            while ($row = mysqli_fetch_assoc($result1)) {
                                $CategoryID = $row['CategoryID'];
                                $CategoryName = $row['CategoryName'];
                                echo "<option class='form-control' value='$CategoryID'>$CategoryName</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <script>
                document.getElementById('CategoryID').addEventListener('change', function () {
                    var selectedIndex = this.selectedIndex;
                    var selectedOption = this.options[selectedIndex];
                    var categoryName = selectedOption.text;

                    document.getElementById('CategoryName').value = categoryName;
                });
            </script>
            <?php
            if (!empty($errorMessage)){
                echo "
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }

            if (!empty($successMessage)){
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