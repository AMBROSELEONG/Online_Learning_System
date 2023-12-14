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
    <div class="container">
        <form method="post">
            <div style="width: 100%; justify-content: space-between; margin: 1% 0; display: flex;">
                <a class="btn btn-primary" href="create.php" role="button">New Client</a>
                <div>
                    <input type="text" name="search" id="search" placeholder="Search Quiz">
                    <input type="submit" name="searchsub" id="searchsub" value="Search">
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Quiz ID</td>
                        <td>Quiz Image</td>
                        <td>Quiz Name</td>
                        <td>Category ID</td>
                        <td>Catrgory Name</td>
                        <td>Operating</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include '../../ConnectDB.php';

                        $sql = "SELECT * FROM quiz";
                        $result = $conn->query($sql);

                        if(!$result){
                            die("Invalid query: " . $conn->error);
                        }

                        while($row = $result->fetch_assoc()){
                            echo " <tr>

                                <td>$row[QuizID]</td>
                                <td>$row[QuizImage]</td>
                                <td>$row[QuizName]</td>
                                <td>$row[CategoryID]</td>
                                <td>$row[CategoryName]</td>

                            <td>
                            <a href='quiz-edit.php?QuizID={$row['QuizID']}' class='btn btn-primary btn-sm'>Edit</a>
                            <a href='quiz-delete.php?QuizID={$row['QuizID']}' class='btn btn-danger btn-sm'>Delete</a>
                            </td>
                        </tr>   
                        ";

                    }
                ?>

                </tbody>
            </table>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>