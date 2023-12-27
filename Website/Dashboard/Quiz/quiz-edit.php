<?php
//include the database connection file
include '../../ConnectDB.php';
//declare variables to store the values from the form
$QuizID = "";
$QuizImage = "";
$QuizName = "";
$CategoryID = "";
$CategoryName = "";

//declare variables to store error and success messages
$error = "";
$success = "";
//check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    //check if the QuizID is set
    if (!isset($_GET['QuizID'])) {
        //if not, redirect to the Quiz.php page
        header("location: Quiz.php");
        exit;
    }
    //store the value of the QuizID from the GET request
    $id = $_GET['QuizID'];

    //query the database to get the values of the QuizID from the GET request
    $sql = "SELECT * FROM quiz WHERE QuizID=$id";
    $result = $conn->query($sql);
    //fetch the row from the result
    $row = $result->fetch_assoc();

    //check if the row is empty
    if (!$row) {
        //if empty, redirect to the Quiz.php page
        header("location: Quiz.php");
        exit;
    }

    //store the values from the row in the variables
    $QuizID = $row['QuizID'];

    $QuizImage = $row['QuizImage'];
    $QuizName = $row['QuizName'];
    $CategoryID = $row['CategoryID'];
    $CategoryName = $row['CategoryName'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //store the value of the file from the POST request
    $filename = $_FILES['QuizImage']['name'];

    //move the file to the quiz-image directory
    if (move_uploaded_file($_FILES['QuizImage']['tmp_name'], "quiz-image/" . $filename)) {
        //store the path of the file in the variable
        $QuizImage = "quiz-image/" . $filename;
    }
    //store the values from the POST request in the variables

    $QuizID = $_GET['QuizID'];
    $QuizID = $_POST['QuizID'];
    $QuizName = $_POST['QuizName'];
    $CategoryID = $_POST['CategoryID'];
    $CategoryName = $_POST['CategoryName'];

    //do the following until the condition is false
    do {
        //check if any of the variables are empty
        if (empty($QuizID) || empty($QuizName) || empty($CategoryID) || empty($CategoryName) || empty($QuizImage)) {
            //if empty, set the error message and break out of the loop
            $error = "All the fields are required";
            break;
        }

        //update the values of the QuizID, QuizImage, QuizName, CategoryID, and CategoryName in the database
        $sql = "UPDATE quiz SET QuizImage='$QuizImage', QuizName = '$QuizName', CategoryID = '$CategoryID', CategoryName = '$CategoryName' WHERE QuizID = '$QuizID'";
        $result = $conn->query($sql);
        //check if the result is empty
        if (!$result) {
            //if empty, set the error message and break out of the loop
            $error = "Error updating record: " . $conn->error;
            break;
        }

        //if successful, set the success message and redirect to the Quiz.php page
        $success = "Quiz Updated Successfully";
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
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2>Edit Quiz</h2>

        <form method="post" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="QuizID" value="<?php echo $QuizID; ?>">
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
                <label class="col-sm-3 col-form-label">Category Name</label>
                <div class="col-sm-6">
                    <select type="text" class="form-control" name="CategoryID" id="CategoryID">
                        <?php
                        //Create a query to select all the categories from the coursecategory table
                        $query1 = "SELECT CategoryID, CategoryName FROM quizcategory";
                        //Execute the query and store the result in the $result1 variable
                        $result1 = mysqli_query($conn, $query1);

                        //Check if the query was successful
                        if (mysqli_num_rows($result1) > 0) {
                            //Loop through the result set
                            echo "<option value='0' selected disabled>Please Select Category</option>";
                            while ($row = mysqli_fetch_assoc($result1)) {
                                //Store the category ID and name in the $Category_ID and $Category_Name variables respectively
                                $Category_ID = $row['CategoryID'];
                                $Category_Name = $row['CategoryName'];
                                //Echo an option element with the category ID and name as the value and text respectively
                                echo "<option class='form-control' value='$Category_ID'>$Category_Name</option>";
                            }
                        } else {
                            //Echo an option element with the text "No Category Found"
                            echo "<option class='form-control' value='0'>No Category Found</option>";
                        }
                        ?>
                    </select>
                    <input type="hidden" name="CategoryName" id="CategoryName" value="<?php echo $Category_Name ?>">
                </div>
            </div>

            <script>
                //This code is used to select an option from the dropdown menu and display the selected option in the textbox
                document.getElementById('CategoryID').addEventListener('change', function () {
                    //Get the selected index of the dropdown menu
                    var selectedIndex = this.selectedIndex;
                    //Get the selected option from the dropdown menu
                    var selectedOption = this.options[selectedIndex];
                    //Get the text of the selected option
                    var categoryName = selectedOption.text;

                    //Display the selected option in the textbox
                    document.getElementById('CategoryName').value = categoryName;
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
                    <button type="submit" class="btn btn-primary" name="EditQuiz">Submit</button>
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