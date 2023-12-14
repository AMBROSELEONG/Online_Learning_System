<?php
include '../../ConnectDB.php';
//Declare variables
$id = "";
$name = "";
$error = "";
$success = "";
//Check if request method is GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    //Check if CategoryID is set in the GET request
    if (!isset($_GET['CategoryID'])) {
        header("location: QuizType.php");
        exit;
    }
    //Set the id to the value of CategoryID
    $id = $_GET['CategoryID'];

    //Query the database for the category name
    $sql = "SELECT * FROM quizcategory WHERE CategoryID=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    //Check if the row is empty
    if (!$row) {
        header("location: QuizType.php");
        exit;
    }

    //Set the name to the value of the row
    $name = $row['CategoryName'];

} else {
    //Set the id and name to the values of the POST request
    $id = $_POST['id'];
    $name = $_POST['name'];

    //Loop until the query is successful
    do {
        //Check if the id and name are empty
        if (empty($id) || empty($name)) {
            $error = "All the fields are required";
            break;
        }
        //Update the database with the new name
        $sql = "UPDATE quizcategory SET CategoryName='$name' WHERE CategoryID=$id";
        $result = $conn->query($sql);

        //Check if the query was successful
        if (!$result) {
            $error = "Invalid query: " . $conn->error;
            break;
        }

        //Set the success message
        $success = "Category Updated Successfully";

        //Redirect to the QuizType page
        header("location: QuizType.php");
        exit;
    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2>Edit Quiz Category</h2>

        <?php
        if (!empty($error)) {
            echo "
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$error</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
        ?>
        <form method="post">
            <input type="hidden" value="<?php echo $id; ?>" name="id">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Category Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>

            <?php
            // Check if the success variable is not empty
            if (!empty($success)) {
                // Display an alert message with the success message
                echo "
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$success</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="QuizType.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>