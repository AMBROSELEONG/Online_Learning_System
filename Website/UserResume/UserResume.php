<?php
include 'find-index.php';
?>
<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Resume</title>
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
                                    <h2 class="m-b-20 p-b-5 b-b-default f-w-600 pt-4">Details</h2>
                                    <div class="col">
                                        <h4 class="m-b-10 f-w-600 pt-4">Experience</h4>
                                        <h6 class="text-muted f-w-400 pb-4">
                                            <?php echo $experience; ?>
                                        </h6>
                                    </div>
                                    <div class="col">
                                        <h4 class="m-b-10 f-w-600 pt-4">Education</h4>
                                        <h6 class="text-muted f-w-400 pb-4">
                                            <?php echo $education; ?>
                                        </h6>
                                    </div>
                                    <div class="col">
                                        <h4 class="m-b-10 f-w-600 pt-4">Professional Skill</h4>
                                        <h6 class="text-muted f-w-400 pb-4">
                                            <ul>
                                                <?php
                                                if ($skillset !== null) {
                                                    $skillsets = explode('/', $skillset);
                                                    foreach ($skillsets as $skill) {
                                                        echo "<li>$skill</li>";
                                                    }
                                                } else {
                                                    echo "<li>No skillset available</li>";
                                                }
                                                ?>
                                            </ul>
                                        </h6>
                                    </div>
                                    <div class="col">
                                        <h4 class="m-b-10 f-w-600 pt-4">Language</h4>
                                        <h6 class="text-muted f-w-400 pb-4">
                                            <ul>
                                                <?php
                                                if ($language !== null) {
                                                    $languages = explode('/', $language);
                                                    foreach ($languages as $lang) {
                                                        echo "<li>$lang</li>";
                                                    }
                                                } else {
                                                    echo "<li>No languages available</li>";
                                                }
                                                ?>
                                            </ul>
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
                        <div class="container">
                            <label for="Experience"><b>Experience</b></label>
                            <input class="form-control" type="text" placeholder="Enter Your Work Experience"
                                name="Experience" id="Experience" value="<?php echo $experience; ?>">
                            <label for="Education"><b>Education</b></label>
                            <input class="form-control" type="text" placeholder="Enter Your Education" name="Education"
                                id="Education" value="<?php echo $education; ?>">

                            <label for="Skillset"><b>Professional Skillset (Branch via '/'. Example - a/b)</b></label>
                            <input class="form-control" type="text" placeholder="Enter Your Professional Skillset"
                                name="Skillset" id="Skillset" value="<?php echo $skillset; ?>">

                            <label for="Language"><b>Language (Branch via '/'. Example - a/b)</b></label>
                            <input class="form-control" type="text" placeholder="Enter Your Language" name="Language"
                                id="Language" value="<?php echo $language; ?>">
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
    // This function creates a list of items from an input field and appends them to a list element
    function createListItems(inputId, listId) {
        // Get the input and list elements from the DOM
        const input = document.getElementById(inputId);
        const list = document.getElementById(listId);

        // Add an event listener to the input field that will run a function when the input is changed
        input.addEventListener('input', function () {
            // Get the values from the input field, split them into an array and trim any whitespace
            const values = input.value.split('/');
            list.innerHTML = '';

            // Loop through each value and append it to the list element if it is not empty
            values.forEach(value => {
                const trimmedValue = value.trim();
                if (trimmedValue !== '') {
                    const listItem = document.createElement('li');
                    listItem.textContent = trimmedValue;
                    list.appendChild(listItem);
                }
            });
        });
    }

    // Call the function to create a list of items from the skillset input and append them to the skillset list
    createListItems('skillsetInput', 'skillsetList');
    // Call the function to create a list of items from the language input and append them to the language list
    createListItems('languageInput', 'languageList');
</script>

</html>