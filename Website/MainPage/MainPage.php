<?php
include "../Session.php"
    ?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Learning System</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://kit.fontawesome.com/439c7cac30.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    .custom-list {
        text-align: right;
        /* Align text to the right */
    }

    .custom-list ul {
        list-style: none;
        /* Remove default list styles */
        padding: 0;
        /* Remove default padding */
    }

    .custom-list ul li {
        direction: rtl;
        /* Right-to-left direction for list items */
        margin-bottom: 5px;
        /* Adjust spacing between list items */
    }
</style>

<body>
    <header class="headerpage mb-5"></header>
    <section>
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../img/Lecturer Img 0.png" alt="Picture 1" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/Lecturer Img 1.png" alt="Picture 2" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/Lecturer 2.png" alt="PIcture 3" class="d-block w-100">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/lecturer 3.png" alt="Picture 4" class="d-block w-100">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="container-fluid text-center align-items-center py-4 bg-light mt-5">
            <h3>Simple online learning system assignments from</h3>
            <div style="d-flex">
                <img src="../img/Logo.png" alt="New Era">
            </div>
        </div>
        <div class="container text-center mt-5">
            <h3>We have everything you need to study online</h3>
            <div class="row">
                <div class="col-md-4">
                    <img src="../img/high_quality.jpg" alt="High Quality" class="img-fluid" style="height: auto;"
                        width="200">
                    <div class="content">
                        <p>High quality, carefully planned courses</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="../img/tutor.jpg" alt="Professional Lecturer" class="img-fluid" style="height: auto;"
                        width="200">
                    <div class="content">
                        <p>Professional Lecturer</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="../img/LiveWebinars.jpg" alt="Live Webinars" class="img-fluid" style="height: auto;"
                        width="200">
                    <div class="content">
                        <p>Live Webinars and more</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img src="../img/Communities.jpg" alt="Communities" class="img-fluid" style="height: auto;"
                        width="200">
                    <div class="content">
                        <p>Engage with communities</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="../img/Course.jpg" alt="Course" class="img-fluid" style="height: auto;" width="200">
                    <div class="content">
                        <p>Create a course that sells</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-md-5 bg-light">
                    <div class="d-inline-block p-5">
                        <h2>Tutorial-container</h2>
                        <ul>
                            <li>Test your professional talent!</li>
                            <li>Discover your creative talents!</li>
                            <li>Reveal your unique personality!</li>
                        </ul>
                        <button class="btn btn-primary" onclick="window.location.href = '../Course/CoursePage.php'">Our
                            course</button>
                    </div>
                </div>

                <div class="col-md-7 d-flex justify-content-center align-items-center">
                    <video src="../img/MainPageVideo.mp4" controls style="width:100%; height:100%" autoplay muted
                        loop></video>
                </div>
            </div>
        </div>
    </section>
    <footer class="footerpage mt-5"></footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        $(function () {
            $(".headerpage").load("../Header.html");
            $(".footerpage").load("../Footer.html");
        });
    </script>
</body>

</html>