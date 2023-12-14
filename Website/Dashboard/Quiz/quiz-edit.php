<?php
include '../../ConnectDB.php';
$id = "";
$image = "";
$name = "";
$price = "";
$type = "";
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

    $name = $row['QuizName'];

} else {
    $id = $_POST['id'];
    $image = $_POST['image'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];
   
    do {
        if (empty($id) || empty($name) || empty($price) || empty($type)) {
            $error = "All the fields are required";
            break;
        }
        $sql = "UPDATE quiz SET QuizName='$name' WHERE QuizID=$id";
        $result = $conn->query($sql);

        if (!$result) {
            $error = "Invalid query: " . $conn->error;
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

            <?php
            if (!empty($errorMessage)){
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            ?>
            <form action="" method="post">
                <div class="mb-3">
                    <label class="col-sm-3 col-form-label">Quiz ID</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="id" value="<?php echo $id;?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="col-sm-3 col-form-label">Quiz Image</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="image" value="<?php echo $image;?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="col-sm-3 col-form-label">Quiz Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="col-sm-3 col-form-label">Quiz Price</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="price" value="<?php echo $price;?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="col-sm-3 col-form-label">Type</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="type" value="<?php echo $type;?>">
                    </div>
                </div>
                <?php
                    if (!empty($successMeassage)){
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