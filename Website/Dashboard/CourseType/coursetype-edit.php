<?php
include '../../ConnectDB.php';
$id = "";
$name = "";
$error = "";
$success = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['CategoryID'])) {
        header("location: CourseType.php");
        exit;
    }
    $id = $_GET['CategoryID'];

    $sql = "SELECT * FROM coursecategory WHERE CategoryID=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: CourseType.php");
        exit;
    }

    $name = $row['CategoryName'];

} else {
    $id = $_POST['id'];
    $name = $_POST['name'];

    do {
        if (empty($id) || empty($name)) {
            $error = "All the fields are required";
            break;
        }
        $sql = "UPDATE coursecategory SET CategoryName='$name' WHERE CategoryID=$id";
        $result = $conn->query($sql);

        if (!$result) {
            $error = "Invalid query: " . $conn->error;
            break;
        }

        $success = "Category Updated Successfully";

        header("location: CourseType.php");
        exit;
    } while (false);
}
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
        <h2>Edit Course Category</h2>

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