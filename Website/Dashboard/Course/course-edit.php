<?php
//include the connection to the database
include '../../ConnectDB.php';
//declare variables to store the course image, name, price, category id and category name
$CourseID = "";
$CourseImage = "";
$CourseName = "";
$CoursePrice = "";
$CategoryID = "";
$CategoryName = "";
$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['CourseID'])) {
        header("Location: Course.php");
        exit;
    }

    $id = $_GET['CourseID'];

    $sql = "SELECT * FROM course WHERE CourseID = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: Course.php");
        exit;
    }

    $CourseID = $row['CourseID'];

    $CourseImage = $row['CourseImage'];
    $CourseName = $row['CourseName'];
    $CoursePrice = $row['CoursePrice'];
    $CategoryID = $row['CategoryID'];
    $CategoryName = $row['CategoryName'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // Use elseif here instead of else
    $Filename = $_FILES['CourseImage']['name'];
    //check if the file has been uploaded successfully
    if (
        move_uploaded_file(
            $_FILES['CourseImage']['tmp_name'],
            "course-image/" . $Filename)
    ) {
        //if the file has been uploaded successfully, store the file path in the course image variable
        $CourseImage = "course-image/" . $Filename;
    } else {
        //if the file has not been uploaded successfully, store an error message in the error variable
        $error = "File could not be uploaded";
    }
    $CourseID = $_POST['CourseID'];
    $CourseName = $_POST['CourseName'];
    $CoursePrice = $_POST['CoursePrice'];
    $CategoryID = $_POST['CategoryID'];
    $CategoryName = $_POST['CategoryName'];

    do {
        if (empty($CourseID) || empty($CourseName) || empty($CoursePrice) || empty($CategoryID) || empty($CategoryName) || empty($CourseImage)) {
            $error = "Please fill in all fields";
            break;
        }
        $sql = "UPDATE course SET CourseImage = '$CourseImage', CourseName = '$CourseName', CoursePrice = '$CoursePrice', CategoryID = '$CategoryID', CategoryName = '$CategoryName' WHERE CourseID = '$CourseID'";
        $result = $conn->query($sql);
        if (!$result) {
            $error = "Error updating record: " . $conn->error;
            break;
        }
        $success = "Course updated successfully";
        header("location: Course.php");
        exit;
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2>Edit Course</h2>

        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="CourseID" value="<?php echo $CourseID; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Image</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" name="CourseImage" value="<?php echo $CourseImage; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="CourseName" value="<?php echo $CourseName; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Category Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="CoursePrice" value="<?php echo $CoursePrice; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Category Name</label>
                <div class="col-sm-6">
                    <select type="text" class="form-control" name="CategoryID" id="CategoryID">
                        <?php
                        $query1 = "SELECT CategoryID, CategoryName FROM coursecategory";
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

            <script>
                document.getElementById('CategoryID').addEventListener('change', function () {
                    var selectedIndex = this.selectedIndex;
                    var selectedOption = this.options[selectedIndex];
                    var categoryName = selectedOption.text;

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
                    <button type="submit" class="btn btn-primary" name="AddCourse">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="Course.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>