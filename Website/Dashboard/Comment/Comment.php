<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form action="" method="post" name="indexf">
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>Comment ID</td>
                    <td>UserName</td>
                    <td>Content</td>
                    <td>CourseName</td>
                    <td>PostDate</td>
                    <td>Operating</td>
                </tr>
                </thead>
                <tbody>
                <?php
                    include '../../ConnectDB.php';

                    $sql = "SELECT * FROM comments";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query" . $conn->$error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo " <tr>
                                    <td>$row[CommentID]</td>
                                    <td>$row[UserName]</td>
                                    <td>$row[Content]</td>
                                    <td>$row[CourseName]</td>
                                    <td>$row[PostDate]</td>
                                    <td>
                                        <a href='comment-delete.php?CommentID=$row[CommentID]' class='btn btn-danger btn-sm'>Delete</a>
                                    </td>
                                </tr>";
}
?>
                </tbody>
            </table>
        </form>
    </div>
    <script type="text/javascript">

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>