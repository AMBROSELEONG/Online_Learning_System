<?php
if (isset($_GET['QuizID'])) {
    include '../../ConnectDB.php';

    $id = $_GET['QuizID'];
    $name = $_GET['QuizName'];
   
    $sql = "DELETE FROM quizquestion WHERE QuizID = $id";

    if ($conn->query($sql) === TRUE) {

        if($conn->query($sql) == TRUE){

            $sql_quiz = "DELETE FROM quiz WHERE QuizID = $id";

            if($conn->query($sql_quiz) === TRUE){
                header('Location: Quiz.php');
                exit;
            }
        }
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>