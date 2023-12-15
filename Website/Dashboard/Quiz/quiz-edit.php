<?php
include '../../ConnectDB.php';
$QuizID = "";
$QuizImage = "";
$QuizName = "";
$CategoryID = "";
$CategoryName = "";
$error = "";
$success = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['QuizID'])) {
        header("location: Quiz.php");
        exit;
    }
    $id = $_GET['QuizID'];

    $sql = "SELECT * FROM quiz WHERE QuizID=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: Quiz.php");
        exit;
    }

    $QuizID = $row['QuizID'];



    $QuizImage = $_POST['QuizImage'];
    $QuizName = $_POST['QuizName'];
    $CategoryID = $_POST['CategoryID'];
    $CategoryName = $_POST['CategoryName'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filename = $_FILES['QuizImage']['name'];

    if (move_uploaded_file($_FILES['QuizImage']['tmp_name'], "quiz-image/" . $filename)) {
        $QuizImage = "quiz-image/" . $filename;
    }
    $QuizID = $_POST['QuizID'];
    $QuizName = $_POST['QuizName'];
    $CategoryID = $_POST['CategoryID'];
    $CategoryName = $_POST['CategoryName'];

    do {
        if (empty($QuizID) || empty($QuizName) || empty($CategorID) || empty($CategoryName)) {
            $error = "All the fields are required";
            break;
        }
        $sql = "UPDATE quiz SET QuizImage='$QuizImage', CourseName = '$QuizName' CategoryID = '$CategoryID', CategoryName = '$CategoryName' WHERE QuizID = '$QuizID'";
        $result = $conn->query($sql);

        if (!$result) {
            $error = "Error updating record: " . $conn->error;
            break;
        }

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
    <div class="container ny-5">
        <h2>New Client</h2>

        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="col-sm-3 col-form-label">Quiz Image</label>
                <div class="col-sm-6">
                    <input type="hidden" class="form-control" name="QuizImage" value="<?php echo $QuizImage; ?>">
                </div>
            </div>
            <div class="mb-3">
                <label class="col-sm-3 col-form-label">Quiz Name</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" name="QuizName" value="<?php echo $QuizName; ?>">
                </div>
            </div>
            <div class="mb-3">
                <label class="col-sm-3 col-form-label">Category Name</label>
                <div class="col-sm-6">
                    <select type="text" class="form-control" name="CategoryName">
                        <?php
                        $query1 = "SELECT CategoryID, CategoryName FROM quizcategory";
                        $result1 = mysqli_query($conn, $query1);

                        if ($result1) {
                            while ($row = mysqli_fetch_assoc($result1)) {
                                $Category_ID = $row['CategoryID'];
                                $Category_Name = $row['CategoryName'];
                                echo "<option class='form-control' value='$Category_ID'>$Category_Name</option>";
                            }
                        } else {
                            echo "<option class='form-control' value='0'>No Category Found</option>";
                        }
                        ?>
                    </select>
                    <input type="hidden" name="CategoryName" id="CategoryName" value="<?php echo $Category_Name ?>">
                </div>
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
    if (!empty($successMeassage)) {
        echo "
                       <div class='row mb-3'>
                            <div class='offset-sm-3 col-sm-6'>
                                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                    <strong>$successMessage</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                            </div>
                        </div>
                        ";
    }

    if (!empty($errorMessage)) {
        echo "
                        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>$errorMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
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