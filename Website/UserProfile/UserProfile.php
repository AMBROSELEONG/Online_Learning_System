<?php
include 'find-index.php';
?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <script src="https://kit.fontawesome.com/439c7cac30.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f9f9fa
        }

        .padding {
            padding: 3rem !important
        }

        .user-card-full {
            overflow: hidden;
        }

        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
            border: none;
            margin-bottom: 30px;
        }

        .m-r-0 {
            margin-right: 0px;
        }

        .m-l-0 {
            margin-left: 0px;
        }

        .user-card-full .user-profile {
            border-radius: 5px 0 0 5px;
        }

        .bg-c-lite-green {
            background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
            background: linear-gradient(to right, #ee5a6f, #f29263);
        }

        .user-profile {
            padding: 20px 0;
        }

        .card-block {
            padding: 1.25rem;
        }

        .m-b-25 {
            margin-bottom: 25px;
        }

        .img-radius {
            border-radius: 5px;
        }



        h6 {
            font-size: 14px;
        }

        .card .card-block p {
            line-height: 25px;
        }

        @media only screen and (min-width: 1400px) {
            p {
                font-size: 14px;
            }
        }

        .card-block {
            padding: 1.25rem;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .card .card-block p {
            line-height: 25px;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .text-muted {
            color: #919aa3 !important;
        }

        .b-b-default {
            border-bottom: 1px solid #e0e0e0;
        }

        .f-w-600 {
            font-weight: 600;
        }

        .m-b-20 {
            margin-bottom: 20px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .p-b-5 {
            padding-bottom: 5px !important;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .m-t-40 {
            margin-top: 20px;
        }

        .user-card-full .social-link li {
            display: inline-block;
        }

        .user-card-full .social-link li a {
            font-size: 20px;
            margin: 0 10px 0 0;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body>
    <header class="headerpage"></header>
    <div class="container">
        <div class="padding">
            <div class="row d-flex justify-content-center">
                <div class="col">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25 pt-4">
                                        <img src="<?php echo $image; ?>" class="img-radius" alt="User-Profile-Image"
                                            width="100%">
                                    </div>
                                    <h1 class="f-w-600 pt-4">
                                        <?php echo $username; ?>
                                    </h1>
                                    <h3 class="pt-4">
                                        <?php echo $collegename; ?>
                                    </h3>
                                    <button type="button" style="background: none; border: none" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <i class="fa-regular fa-pen-to-square py-5 text-white" id="myBtn"
                                            style="cursor: pointer;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h2 class="m-b-20 p-b-5 b-b-default f-w-600 pt-4">Information</h2>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4 class="m-b-10 f-w-600 pt-4">Email</h4>
                                            <h6 class="text-muted f-w-400 pb-4">
                                                <?php echo $gmail; ?>
                                            </h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4 class="m-b-10 f-w-600 pt-4">Phone</h4>
                                            <h6 class="text-muted f-w-400 pb-4">
                                                <?php echo $phone; ?>
                                            </h6>
                                        </div>
                                    </div>
                                    <h2 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600 pt-4">About</h2>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="m-b-10 f-w-600 pt-4">About Me</h4>
                                            <h6 class="text-muted f-w-400 pb-4">
                                                <?php echo $about; ?>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footerpage"></footer>
    <script>
        $(function () {
            $(".headerpage").load("../Header.html");
            $(".footerpage").load("../Footer.html");
        });
    </script>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="insert-index.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col d-flex justify-content-center">
                                <img class="img-show" id="img-show"
                                    src="<?php echo !empty($image) ? $image : 'img/user_background.png'; ?>"
                                    style="width: 20rem; height: 20rem; border: 1px solid black; border-radius: 50%; margin: 0 auto; "><br>
                            </div>
                            <input type="file" id="img-input" name="userImage" onchange="fileChange(this)"
                                accept=".jpg, .jpeg, .png, .gif">
                        </div>
                        <div class="container">
                            <label for="Username"><b>Username</b></label>
                            <input class="form-control" type="text" placeholder="Enter Username" name="Username"
                                id="Username" value="<?php echo $username; ?>">

                            <label for="CollegeName"><b>College Name</b></label>
                            <input class="form-control" type="text" placeholder="Enter College Name" name="CollegeName"
                                id="CollegeName" value="<?php echo $collegename; ?>">

                            <label for="Gmail"><b>Gmail</b></label>
                            <input class="form-control" type="text" placeholder="Enter Gmail" name="Gmail" id="Gmail"
                                value="<?php echo $gmail; ?>">

                            <label for="Phone"><b>Phone Number</b></label>
                            <input class="form-control" type="text" placeholder="Enter Phone" name="Phone" id="Phone"
                                value="<?php echo $phone; ?>">

                            <br>
                            <label for="About"><b>About Me</b></label>
                            <br>
                            <textarea class="form-control" name="About" id="About" cols="30rem" rows="10"
                                style="padding: 10px"><?php echo $about; ?></textarea>
                            <br>
                            <button type="submit" class="btn btn-primary" name="save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
<script>
    //This function is used to change the image when a new file is selected
    function fileChange(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var imgShow = document.getElementById('img-show');
                imgShow.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</html>