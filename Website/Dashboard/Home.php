<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="icon-Home/iconfont.css">
    <script src="icon-Home/iconfont.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .my-col {
            margin: 10px;
        }

        .custom-bg {
            background-color: #f0f0f0;
        }

        .color-col-bg {
            background-color: #ffffff;
        }

        .line {
            border-right: #f0f0f0 2px solid;
        }

        .icon {
            width: 1em;
            height: 1em;
            vertical-align: -0.15em;
            fill: currentColor;
            overflow: hidden;
            font-size: 30px;
        }

        @font-face {
            font-family: "FX_LED";
            src: url("../Font/FX-LED.ttf");
        }

        @font-face {
            font-family: "Hack";
            src: url("../Font/Hack-Bold.ttf");
        }

        .digital-clock {
            color: #fff;
            display: flex;
            border-radius: 2rem;
            user-select: none;
            padding: 0 2rem;
            background-color: #000;
            border: 0.5rem solid #2d2d2d;
        }

        .time {
            font-family: "FX_LED";
            line-height: 3;
            display: flex;
        }

        .day,
        .hour,
        .min,
        .sec,
        .dot {
            display: inline-block;
            font-size: 4rem;
        }

        .min {
            display: math;
        }

        .invsible {
            visibility: hidden;
        }
    </style>
</head>

<body class="custom-bg mx-4">
    <div class="row">
        <div class="col color-col-bg px-4 py-3 mb-4 mx-2 mt-4 bg-warning">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 line">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-icon_yonghuguanli"></use>
                                </svg>
                            </div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center text-white">User
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center fs-4 text-white">
                        <?php
                        include '../ConnectDB.php';

                        $userQuery = $conn->prepare("SELECT COUNT(*) AS UserID FROM users ");
                        $userQuery->execute();
                        $result1 = $userQuery->get_result();

                        if ($result1->num_rows > 0) {
                            $row1 = $result1->fetch_assoc();
                            $UserCount = $row1['UserID'];
                        }

                        $userQuery->close();
                        echo $UserCount;
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col color-col-bg px-4 py-3 d-flex mb-4 mx-2 mt-4 bg-success">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 line">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-dingdan-"></use>
                                </svg>
                            </div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center text-white">Order
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center fs-4 text-white">
                        <?php
                        include '../ConnectDB.php';

                        $orderQuery = $conn->prepare("SELECT COUNT(*) AS OrderID FROM orders ");
                        $orderQuery->execute();
                        $result2 = $orderQuery->get_result();

                        if ($result2->num_rows > 0) {
                            $row2 = $result2->fetch_assoc();
                            $OrderCount = $row2['OrderID'];
                        }

                        $orderQuery->close();
                        echo $OrderCount;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col color-col-bg px-4 py-3 d-flex mb-4 mx-2 mt-4 bg-danger">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 line">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-xiaoliang"></use>
                                </svg>
                            </div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center text-white">Sales
                                Volume</div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center fs-4 text-white">
                        <?php
                        include '../ConnectDB.php';

                        $totalQuery = $conn->prepare("SELECT SUM(CoursePrice) AS TotalCoursePrice FROM orders");
                        $totalQuery->execute();
                        $result3 = $totalQuery->get_result();

                        if ($result3->num_rows > 0) {
                            $row3 = $result3->fetch_assoc();
                            $TotalCoursePrice = $row3['TotalCoursePrice'];
                        }

                        $totalQuery->close();
                        echo 'RM ' . $TotalCoursePrice;
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col color-col-bg px-4 py-3 d-flex mb-4 mx-2 mt-4 bg-info">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 line">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-kechengshouye-yanxuekecheng"></use>
                                </svg>
                            </div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center text-white">Course
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center fs-4 text-white">
                        <?php
                        include '../ConnectDB.php';

                        $courseQuery = $conn->prepare("SELECT COUNT(*) AS CourseID FROM course ");
                        $courseQuery->execute();
                        $result4 = $courseQuery->get_result();

                        if ($result4->num_rows > 0) {
                            $row4 = $result4->fetch_assoc();
                            $CourseCount = $row4['CourseID'];
                        }

                        $courseQuery->close();
                        echo $CourseCount;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col color-col-bg mx-2 pt-4">
            <?php
            include '../ConnectDB.php';

            $sql = "SELECT OrderDate, COUNT(*) AS OrderCount
                    FROM orders
                    WHERE OrderDate >= CURDATE() - INTERVAL 10 DAY
                    GROUP BY OrderDate
                    ORDER BY OrderDate";

            $result = $conn->query($sql);

            $dates = [];
            $orderCounts = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $dates[] = $row['OrderDate'];
                    $orderCounts[] = $row['OrderCount'];
                }
            }

            ?>
            <canvas id="myChart" style="width: 100%;"></canvas>
            <script>
                const dates = <?php echo json_encode($dates); ?>;
                const orderCounts = <?php echo json_encode($orderCounts); ?>;

                new Chart("myChart", {
                    type: "line",
                    data: {
                        labels: dates,
                        datasets: [{
                            label: 'Orders',
                            fill: false,
                            lineTension: 0,
                            backgroundColor: "rgba(0,0,255,1.0)",
                            borderColor: "rgba(0,0,255,0.1)",
                            data: orderCounts
                        }]
                    },
                    options: {
                        legend: { display: true },
                        scales: {
                            yAxes: [{ ticks: { beginAtZero: true } }],
                        }
                    }
                });
            </script>
        </div>
        <div class="col-md-4 color-col-bg mx-2 pt-4">
            <?php
            $orderCategoryQuery = "
           SELECT c.CategoryName, COUNT(*) AS OrderCount 
           FROM orders o 
           JOIN course c ON o.CourseName = c.CourseName 
           GROUP BY c.CategoryName ";

            $result = $conn->query($orderCategoryQuery);

            $categories = [];
            $orderCounts = [];
            $colors = ["red", "green", "blue", "orange", "brown"]; // 可以自定义颜色
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $categories[] = $row['CategoryName'];
                    $orderCounts[] = $row['OrderCount'];
                }
            }
            ?>
            <canvas id="Pie" style="width: 100%; margin-top: 10%;"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const xPie = <?php echo json_encode($categories); ?>;
                const yPie = <?php echo json_encode($orderCounts); ?>;
                const ColorPie = <?php echo json_encode($colors); ?>;

                new Chart("Pie", {
                    type: "doughnut",
                    data: {
                        labels: xPie,
                        datasets: [{
                            backgroundColor: ColorPie,
                            data: yPie
                        }]
                    },
                    options: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: "Course Category Distribution"
                        }
                    }
                });
            </script>
        </div>
    </div>
    <div class="row">
        <div class="col align-items-center color-col-bg mx-2 pt-4 mt-4">
            <div class="row">
                <div class="col align-items-center text-center">
                    <h3>Review</h3>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex align-items-center">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Content</td>
                                <td>CourseName</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../ConnectDB.php';

                            $sql = "SELECT * FROM comments ORDER BY CommentID DESC LIMIT 5";
                            $result = $conn->query($sql);

                            if (!$result) {
                                die("Invalid query" . $conn->error);
                            }

                            $commentCount = $result->num_rows;
                            $displayCount = min($commentCount, 5);

                            echo "<tbody>";
                            for ($i = 0; $i < $displayCount; $i++) {
                                $row = $result->fetch_assoc();
                                echo "<tr>
                                        <td>{$row['UserName']}</td>
                                        <td>{$row['Content']}</td>
                                        <td>{$row['CourseName']}</td>
                                    </tr>";
                            }
                            echo "</tbody>";
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col align-items-center color-col-bg mx-2 pt-4 mt-4">
            <div class="row">
                <div class="col align-items-center text-center">
                    <h3>Employee</h3>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex align-items-center">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>ID</td>
                                <td>Name</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2290077</td>
                                <td>LEONG WEI JUN</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2270391</td>
                                <td>ERIC CHONG WAI</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>2290036</td>
                                <td>NG RUEY JYH</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>2290193</td>
                                <td>LEE JUN HO</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col align-items-center color-col-bg mx-2 pt-4 mt-4">
            <div class="row">
                <div class="col align-items-center text-center">
                    <h3>Open Hour</h3>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="digital-clock">
                        <div class="time">
                            <div class="day"></div>
                            <div class="dot">:</div>
                            <div class="hour"></div>
                            <div class="dot">:</div>
                            <div class="min"></div>
                            <div class="dot">:</div>
                            <div class="sec"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <script>
            const $ = (selector) => {
                return document.querySelector(selector);
            }

            function calculateBusinessHours(startDate) {
                const currentDate = new Date();
                const diffMilliseconds = currentDate - startDate;

                const totalSeconds = Math.floor(diffMilliseconds / 1000);
                const totalMinutes = Math.floor(totalSeconds / 60);
                const totalHours = Math.floor(totalMinutes / 60);
                const totalDays = Math.floor(totalHours / 24);

                const hours = totalHours % 24;
                const minutes = totalMinutes % 60;
                const seconds = totalSeconds % 60;

                return {
                    days: totalDays,
                    hours: hours.toString().padStart(2, '0'),
                    minutes: minutes.toString().padStart(2, '0'),
                    seconds: seconds.toString().padStart(2, '0')
                };
            }

            const startDate = new Date("2023-12-20");

            function updateClock() {
                const businessTime = calculateBusinessHours(startDate);

                $('.day').textContent = `${businessTime.days}`;
                $('.hour').textContent = `${businessTime.hours}`;
                $('.min').textContent = `${businessTime.minutes}`;
                $('.sec').textContent = `${businessTime.seconds}`;

                const dots = document.querySelectorAll('.dot');
                dots.forEach(dot => {
                    if (businessTime.seconds % 2 === 0) {
                        dot.classList.add("invisible");
                    } else {
                        dot.classList.remove("invisible");
                    }
                });
            }

            setInterval(updateClock, 1000);
            updateClock();
        </script>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>