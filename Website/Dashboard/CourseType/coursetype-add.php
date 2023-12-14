<?php
include '../../ConnectDB.php';
//Declare variables to store the name, error, and success messages
$name = "";
$error = "";
$success = "";
//Check if the request method is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Store the name from the POST request in the $name variable
    $name = $_POST['name'];

    //Loop until the name is valid
    do {
        //Check if the name is empty
        if (empty($name)) {
            //If empty, set the error message and break out of the loop
            $error = "Please enter a Category Name";
            break;
        }

        //Create an SQL query to insert the name into the coursecategory table
        $sql = "INSERT INTO coursecategory(CategoryName) VALUES ('$name')";
        //Execute the query
        $result = $conn->query($sql);

        //Check if the query was successful
        if (!$result) {
            //If not, set the error message and break out of the loop
            $error = "Invalid query: " . $conn->error;
            break;
        }

        //Set the name and success messages
        $name = "";
        $success = "Category Added Successfully";

        //Redirect the user to the CourseType.php page
        header("location: CourseType.php");
        exit;

    } while (false);
}
//Display the page with the error, success, and name messages
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2>New Course Category</h2>

        <?php
        if (!empty($error)) {
            echo "
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$error</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
        ?>
        <form action="" method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Category Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
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
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="CourseType.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>