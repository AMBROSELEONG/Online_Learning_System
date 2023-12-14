<?php
// 连接数据库
include '../../ConnectDB.php';
// 定义变量
$id = "";
$name = "";
$error = "";
$success = "";
// 判断请求方式
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // 判断是否有CategoryID参数
    if (!isset($_GET['CategoryID'])) {
        // 如果没有，跳转到CourseType.php
        header("location: CourseType.php");
        exit;
    }
    // 获取CategoryID参数
    $id = $_GET['CategoryID'];

    // 查询数据库
    $sql = "SELECT * FROM coursecategory WHERE CategoryID=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // 判断查询结果
    if (!$row) {
        // 如果没有，跳转到CourseType.php
        header("location: CourseType.php");
        exit;
    }

    // 获取查询结果
    $name = $row['CategoryName'];

} else {
    // 获取表单数据
    $id = $_POST['id'];
    $name = $_POST['name'];

    // 循环执行
    do {
        // 判断是否有必填字段
        if (empty($id) || empty($name)) {
            // 如果没有，设置错误信息
            $error = "All the fields are required";
            break;
        }
        // 更新数据库
        $sql = "UPDATE coursecategory SET CategoryName='$name' WHERE CategoryID=$id";
        $result = $conn->query($sql);

        // 判断更新结果
        if (!$result) {
            // 如果没有，设置错误信息
            $error = "Invalid query: " . $conn->error;
            break;
        }

        // 设置更新成功信息
        $success = "Category Updated Successfully";

        // 跳转到CourseType.php
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
        // 判断是否有错误信息
        if (!empty($error)) {
            // 如果有，显示错误信息
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
            // 判断是否有更新成功信息
            if (!empty($success)) {
                // 如果有，显示更新成功信息
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