<?php

//include the connection to the database
include '../../ConnectDB.php';

//set the initial values of the variables
$QuizImage = "";
$QuizName = "";
$CategoryID = "";
$CategoryName = "";

$error = "";
$success = "";

//check if the add quiz button has been clicked
if (isset($_POST['AddQuiz'])) {

    //store the name of the file in the variable
    $Filename = $_FILES['QuizImage']['name'];

    //check if the file has been uploaded successfully
    if (
        move_uploaded_file(
            $_FILES['QuizImage']['tmp_name'],
            "quiz-image/" . $Filename)
    ) {

        //if the file has been uploaded successfully, store the path of the file in the QuizImage variable
        $QuizImage = "quiz-image/" . $Filename;

    } else {
        //if the file has not been uploaded successfully, store an error message in the error variable
        $error = "File could not be uploaded";
    }

    //store the values of the form in the variables
    $QuizName = $_POST['QuizName'];
    $CategoryID = $_POST['CategoryID'];
    $CategoryName = $_POST['CategoryName'];

    //store the query to add the course in a variable
    $query = "INSERT INTO quiz(QuizImage, QuizName, CategoryID, CategoryName) VALUES ('$QuizImage', '$QuizName','$CategoryID','$CategoryName')";
    //execute the query to add the course
    $result = mysqli_query($conn, $query);
    //check if the query has been executed successfully
    if ($result) {
        //if the query has been executed successfully, store a success message in the success variable
        $success = "Quiz Added Successfully";
        //redirect the user to the Quiz.php page
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
    <title>Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container ny-5">
        <h2>New Quiz</h2>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Quiz Image</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" name="QuizImage">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Quiz Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="QuizName" value="<?php echo $QuizName; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Category Name</label>
                <div class="col-sm-6">
                    <select type="text" class="form-control" name="CategoryID" id="CategoryID">
                        <?php
                        // Create a query to select all the categories from the quizcategory table
                        $query1 = "SELECT CategoryID, CategoryName FROM quizcategory";
                        // Execute the query and store the result in the $result1 variable
                        $result1 = mysqli_query($conn, $query1);

                        // Check if the query was successful
                        if ($result1) {
                            // Loop through the result set
                            while ($row = mysqli_fetch_assoc($result1)) {
                                // Store the values from the result set in the $CategoryID and $CategoryName variables
                                $Category_ID = $row['CategoryID'];
                                $Category_Name = $row['CategoryName'];
                                // Print the option element with the values from the result set
                                echo "<option class='form-control' value='$Category_ID'>$Category_Name</option>";
                            }
                        } else {
                            // Display a message if no category was found
                            echo "<option class='form-control' value='0'>No Category Found</option>";
                        }
                        ?>
                    </select>
                    <input type="hidden" name="CategoryName" id="CategoryName" value="<?php echo $Category_Name ?>">
                </div>
            </div>

            <script>
                //This code adds an event listener to the 'CategoryID' element, which will be triggered when the user selects an option from the dropdown menu. 
                document.getElementById('CategoryID').addEventListener('change', function () {
                    //This variable stores the index of the selected option.
                    var selectedIndex = this.selectedIndex;
                    //This variable stores the selected option.
                    var selectedOption = this.options[selectedIndex];
                    //This variable stores the text of the selected option.
                    var categoryName = selectedOption.text;

                    //This line sets the value of the 'CategoryName' element to the value of the 'categoryName' variable.
                    document.getElementById('CategoryName').value = categoryName;
                });
            </script>
            <?php
            if (!empty($errorMessage)) {
                echo "
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }

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
                    <button type="submit" class="btn btn-primary" name="AddQuiz">Submit</button>
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