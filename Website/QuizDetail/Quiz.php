<?php
include "../ConnectDB.php";

$QuizID = $_GET['QuizID'];
$sql = "SELECT * FROM quizquestion WHERE QuestionText = 'Artificial Scientifically Intelligence'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Invalid Query" . $conn->error);
}

$row = mysqli_fetch_assoc($result);

// At the beginning of the page or wherever you want to display the message
session_start();

// Check if the success message exists and display it
if (isset($_SESSION['cart_message'])) {
    echo "<script type='text/javascript'>alert('{$_SESSION['cart_message']}')</script>";
    unset($_SESSION['cart_message']); // Clear the message after displaying it
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Artificial Scientifically Intelligence Quiz </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<style>
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        animation: animatezoom 0.5s;
    }

    .modal-content {
        background-color: #fff;
        width: 50rem;
        height: 20rem;
        margin: 15rem auto;
        padding: 2rem;
        text-align: center;
        border-radius: 0.5rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

    }

    .modal-content>div {
        width: 80%;
        margin: 5%;
        padding: 5%;
        border: 1px solid black;
        font-size: 2rem;
    }

    #startQuizButton,
    #cancelQuizButton {
        margin: 10px;
        padding: 10px 20px;
        border: none;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }

    #startQuizButton:hover,
    #cancelQuizButton:hover {
        background-color: #0056b3;
    }
</style>

<body style="background-image: url(../img/quiz.jpg); background-repeat: no-repeat; background-size: cover;">
<form method="post" action="<?php echo $row['QuizID']; ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="text-align: center; margin-top: 10%;">
                <h1>QUIZ</h1>
            </div>
                <div class="col-md-12">
                    <div class="card"
                        style="backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px); background-color: rgba(255,255, 255,0.5);">
                        <div class="card-body">
                            <h5 class="card-title">Question 1</h5>
                            <h5>Which HTML element is not considered a landmark element?*</h5>
                            <form>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="q1" id="q1-option1" value="option1">
                                    <label class="form-check-label" for="q1-option1">form</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="q1" id="q1-option2" value="option2">
                                    <label class="form-check-label" for="q1-option2">ul</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="q1" id="q1-option3" value="option3">
                                    <label class="form-check-label" for="q1-option3">main</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="q1" id="q1-option4" value="option4">
                                    <label class="form-check-label" for="q1-option4">nav</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <div class="col-md-12">
                <div class="card"
                    style="backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px); background-color: rgba(255,255, 255,0.5);">
                    <div class="card-body">
                        <h5 class="card-title">Question 2</h5>
                        <h5>Which choice is not part of CSS box model*</h5>
                        <form>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q2" id="q2-option1" value="option1">
                                <label class="form-check-label" for="q2-option1">margin</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q2" id="q2-option2" value="option2">
                                <label class="form-check-label" for="q2-option2">border</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q2" id="q2-option3" value="option3">
                                <label class="form-check-label" for="q2-option3">padding</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q2" id="q2-option4" value="option4">
                                <label class="form-check-label" for="q2-option4">paragraph</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card"
                    style="backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px); background-color: rgba(255,255, 255,0.5);">
                    <div class="card-body">
                        <h5 class="card-title">Question 3</h5>
                        <h5>What is the <label> element used for?*</h5>
                        <form>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q3" id="q3-option1" value="option1">
                                <label class="form-check-label" for="q3-option1">to identify the difference parts of a figure</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q3" id="q3-option2" value="option2">
                                <label class="form-check-label" for="q3-option2">to explain what needs to be entered into a form field</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q3" id="q3-option3" value="option3">
                                <label class="form-check-label" for="q3-option3">as a caption for images</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q3" id="q3-option4" value="option4">
                                <label class="form-check-label" for="q3-option4">as a heading for tables</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card"
                    style="backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px); background-color: rgba(255,255, 255,0.5);">
                    <div class="card-body">
                        <h5 class="card-title">Question 4</h5>
                        <h5>What does the === comparison operator do?*</h5>
                        <form>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q4" id="q4-option1" value="option1">
                                <label class="form-check-label" for="q4-option1">It sets one variable equal to another in both value and type</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q4" id="q4-option2" value="option2">
                                <label class="form-check-label" for="q4-option2">It tests for equality of type only</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q4" id="q4-option3" value="option3">
                                <label class="form-check-label" for="q4-option3">It tests for equality of value only</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q4" id="q4-option4" value="option4">
                                <label class="form-check-label" for="q4-option4">It tests for equality of value and type</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="text-align: center; color: red;">
                <p>Please Be Aware!! There are a few precautions and rules during the examination start as below:</p>
                <p>1. DO NOT USED ChatGPT</p>
                <p>2. Your actions of cheating WILL BE on the COURT OF LAWS.</p>
                <p>3. During the examination, your actions are being monitored until you had done your online exams
                    sheet.
                </p>

            </div>
        </div>
    </div>
    <div id="quizModal" class="modal">
        <div class="modal-content">
            <div>
                <h1>YOUR GRADE IS </h1>
            </div>
            <button id="startQuizButton" onclick="window.location.href='../Quiz/QuizList.php'">Yes</button>
        </div>
    </div>
    
   <script>
        // Get the modal and the start and cancel buttons
        var modal = document.getElementById('quizModal');
        var startButton = document.getElementById('startQuizButton');
        var cancelButton = document.getElementById('cancelQuizButton');

        // Open the modal when the start button is clicked
        function openModal() {
            modal.style.display = 'block';
        }

        // Close the modal when the cancel button is clicked
        function closeModal() {
            modal.style.display = 'none';
        }

        // Add an event listener to the start button to close the modal when clicked
        startButton.addEventListener('click', function () {
            closeModal();
        });

        // Add an event listener to the cancel button to close the modal when clicked
        cancelButton.addEventListener('click', function () {
            closeModal();
        });
    </script>
    <?php
    echo '<body style="background-image: url(../img/quiz.jpg); background-repeat: no-repeat; background-size: cover;">';

    echo '<button class="btn btn-primary col-md-12" style="margin-bottom: 5%;" onclick="openModal()">Submit</button>';
    
    echo '<div id="quizModal" class="modal">';
    echo '<div class="modal-content">';
    echo '<div>';
    echo '<h1>YOUR GRADE IS </h1>';
    echo '</div>';
    echo '<button id="startQuizButton" onclick="window.location.href=\'../Quiz/QuizList.php\'">Yes</button>';
    echo '</div>';
    echo '</div>';
?>
</form>
</body>
</html>