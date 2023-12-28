<?php
include "../ConnectDB.php";

$QuizID = $_GET['QuizID'];
$sql = "SELECT * FROM quizquestion WHERE QuizID = '$QuizID'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Invalid Query" . $conn->error);
}
$row = mysqli_fetch_assoc($result);
$OptOne = array(
    $row['OptOne1'],
    $row['OptOne2'],
    $row['OptOne3'],
    $row['AnsOne']
);

$OptTwo = array(
    $row['OptTwo1'],
    $row['OptTwo2'],
    $row['OptTwo3'],
    $row['AnsTwo']
);

$OptThree = array(
    $row['OptThree1'],
    $row['OptThree2'],
    $row['OptThree3'],
    $row['AnsThree']
);

$OptFour = array(
    $row['OptFour1'],
    $row['OptFour2'],
    $row['OptFour3'],
    $row['AnsFour']
);
$decodedQuestionOne = array_map('htmlspecialchars_decode',$OptOne);
$decodedQuestionTwo = array_map('htmlspecialchars_decode',$OptTwo);
$decodedQuestionThree = array_map('htmlspecialchars_decode',$OptThree);
$decodedQuestionFour = array_map('htmlspecialchars_decode',$OptFour);

// Shuffle options randomly
shuffle($decodedQuestionOne);
shuffle($decodedQuestionTwo);
shuffle($decodedQuestionThree);
shuffle($decodedQuestionFour);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total_score = 0;
    $score_per_question = 25;

    $user_answers = [
        $_POST['q1'] ?? null,
        $_POST['q2'] ?? null,
        $_POST['q3'] ?? null,
        $_POST['q4'] ?? null,
    ];

    $correct_answers = [
        $row['AnsOne'],
        $row['AnsTwo'],
        $row['AnsThree'],
        $row['AnsFour'],
    ];

    // Loop through user answers and correct answers to calculate score
    for ($i = 0; $i < count($user_answers); $i++) {
        if ($user_answers[$i] == $correct_answers[$i]) {
            $total_score += $score_per_question;
        }
    }

    echo "<script>";
    echo "document.addEventListener('DOMContentLoaded', function() {
            openModal();
            document.getElementById('scoreDisplay').innerText = 'Your score is: " . $total_score . "';
          });";
    echo "</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
</head>

<body style="background-image: url(../img/quiz.jpg); background-repeat: no-repeat; background-size: cover;">
    <form method="post">
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
                            <h5>
                                <?php echo $row['QuestionOne'] ?>
                            </h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q1" id="q1-option1"
                                    value="<?php echo htmlspecialchars($decodedQuestionOne[0]); ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q1-option1">
                                    <?php echo htmlspecialchars($decodedQuestionOne[0]); ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q1" id="q1-option2"
                                    value="<?php echo htmlspecialchars($decodedQuestionOne[1]); ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q1-option2">
                                    <?php echo htmlspecialchars($decodedQuestionOne[1]); ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q1" id="q1-option3"
                                    value="<?php echo htmlspecialchars($decodedQuestionOne[2]); ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q1-option3">
                                    <?php echo htmlspecialchars($decodedQuestionOne[2]); ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q1" id="q1-option4"
                                    value="<?php echo htmlspecialchars($decodedQuestionOne[3]); ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q1-option4">
                                    <?php echo htmlspecialchars($decodedQuestionOne[3]); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card"
                        style="backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px); background-color: rgba(255,255, 255,0.5);">
                        <div class="card-body">
                            <h5 class="card-title">Question 2</h5>
                            <h5>
                                <?php echo $row['QuestionTwo'] ?>
                            </h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q2" id="q2-option1"
                                    value="<?php echo htmlspecialchars($decodedQuestionTwo[0]); ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q2-option1">
                                    <?php echo htmlspecialchars($decodedQuestionTwo[0]); ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q2" id="q2-option2"
                                    value="<?php echo htmlspecialchars($decodedQuestionTwo[1]); ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q2-option2">
                                    <?php echo htmlspecialchars($decodedQuestionTwo[1]); ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q2" id="q2-option3"
                                    value="<?php echo htmlspecialchars($decodedQuestionTwo[2]); ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q2-option3">
                                    <?php echo htmlspecialchars($decodedQuestionTwo[2]); ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q2" id="q2-option4"
                                    value="<?php echo htmlspecialchars($decodedQuestionTwo[3]); ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q2-option4">
                                    <?php echo htmlspecialchars($decodedQuestionTwo[3]); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card"
                        style="backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px); background-color: rgba(255,255, 255,0.5);">
                        <div class="card-body">
                            <h5 class="card-title">Question 3</h5>
                            <h5>
                                <?php echo $row['QuestionThree'] ?>
                            </h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q3" id="q3-option1"
                                    value="<?php echo htmlspecialchars($decodedQuestionThree[0]); ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q3-option1">
                                    <?php echo htmlspecialchars($decodedQuestionThree[0]); ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q3" id="q3-option2"
                                    value="<?php echo htmlspecialchars($decodedQuestionThree[1]); ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q3-option2">
                                    <?php echo htmlspecialchars($decodedQuestionThree[1]); ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q3" id="q3-option3"
                                    value="<?php echo htmlspecialchars($decodedQuestionThree[2]); ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q3-option3">
                                    <?php echo htmlspecialchars($decodedQuestionThree[2]); ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q3" id="q3-option4"
                                    value="<?php echo htmlspecialchars($decodedQuestionThree[3]) ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q3-option4">
                                    <?php echo htmlspecialchars($decodedQuestionThree[3]); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card"
                        style="backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px); background-color: rgba(255,255, 255,0.5);">
                        <div class="card-body">
                            <h5 class="card-title">Question 4</h5>
                            <h5>
                                <?php echo $row['QuestionFour'] ?>
                            </h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q4" id="q4-option1"
                                    value="<?php echo htmlspecialchars($decodedQuestionFour[0]); ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q4-option1">
                                    <?php echo htmlspecialchars($decodedQuestionFour[0]); ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q4" id="q4-option2"
                                    value="<?php echo htmlspecialchars($decodedQuestionFour[1]); ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q4-option2">
                                    <?php echo htmlspecialchars($decodedQuestionFour[1]); ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q4" id="q4-option3"
                                    value="<?php echo htmlspecialchars($decodedQuestionFour[2]); ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q4-option3">
                                    <?php echo htmlspecialchars($decodedQuestionFour[2]); ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="q4" id="q4-option4"
                                    value="<?php echo htmlspecialchars($decodedQuestionFour[3]); ?>" onchange="checkSelection()">
                                <label class="form-check-label" for="q4-option4">
                                    <?php echo htmlspecialchars($decodedQuestionFour[3]); ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="text-align: center; color: red;">
                    <p>Please Be Aware!! There are a few precautions and rules during the examination start as below:
                    </p>
                    <p>1. DO NOT USED ChatGPT</p>
                    <p>2. Your actions of cheating WILL BE on the COURT OF LAWS.</p>
                    <p>3. During the examination, your actions are being monitored until you had done your online exams
                        sheet.
                    </p>
                </div>
                <button class="btn btn-primary col-md-12" id="submitBtn" style="margin-bottom: 5%;"
                    onclick="return validateForm();" disabled>Submit</button>
                <script>
                    function checkSelection() {
                        let isQ1Checked = document.querySelector('input[name="q1"]:checked');
                        let isQ2Checked = document.querySelector('input[name="q2"]:checked');
                        let isQ3Checked = document.querySelector('input[name="q3"]:checked');
                        let isQ4Checked = document.querySelector('input[name="q4"]:checked');

                        let submitBtn = document.getElementById('submitBtn');

                        if (isQ1Checked && isQ2Checked && isQ3Checked && isQ4Checked) {
                            submitBtn.removeAttribute('disabled');
                        } else {
                            submitBtn.setAttribute('disabled', 'true');
                        }
                    }
                </script>

            </div>
        </div>
        <div id="quizModal" class="modal">
            <div class="modal-content">
                <div>
                    <div id="scoreDisplay"></div>
                </div>
                <a id="startQuizButton" onclick="window.location.href='../Quiz/QuizList.php'">Yes</a>
            </div>
        </div>
        <script>
            // Get the modal and the start and cancel buttons
            var modal = document.getElementById('quizModal');

            // Open the modal when the start button is clicked
            function openModal() {
                modal.style.display = 'block';
            }
        </script>
    </form>
</body>

</html>