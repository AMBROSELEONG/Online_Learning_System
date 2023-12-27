<?php
//include the connection to the database
include '../../ConnectDB.php';
//declare variables to store the course image, name, price, category id and category name
$CourseID = "";
$CourseImage = "";
$CourseName = "";
$CoursePrice = "";
$CourseDescription = "";
$CategoryID = "";
$CategoryName = "";
$LecturerID = "";
$LecturerName = "";
$LecturerQualification = "";
$StudyDuration = "";
$LearningPlatform = "";
$LearningResult = "";
$CourseOutline = "";

$error = "";
$success = "";

//check if the request method is a GET request
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //check if the course id is set
    if (!isset($_GET['CourseID'])) {
        //if the course id is not set, redirect to the course page
        header("Location: CourseDetail.php");
        exit;
    }

    //store the course id in the id variable
    $id = $_GET['CourseID'];

    //query the database to get the course information
    $sql = "SELECT * FROM coursedetail WHERE CourseID = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    //check if the course information is returned
    if (!$row) {
        //if the course information is not returned, redirect to the course page
        header("Location: CourseDetail.php");
        exit;
    }

    //store the course information in the corresponding variables
    $CourseID = $row['CourseID'];
    $CourseName = $row['CourseName'];
    $CourseDescription = $row['CourseDescription'];
    $LecturerName = $row['LecturerName'];
    $LecturerQualification = $row['LecturerQualification'];
    $StudyDuration = $row['StudyDuration'];
    $LearningPlatform = $row['LearningPlatform'];
    $LearningResult = $row['LearningResult'];
    $CourseOutline = $row['CourseOutline'];

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') { // Use elseif here instead of else
    //store the course information in the corresponding variables
    $CourseID = $_GET['CourseID'];
    $CourseID = $_POST['CourseID'];
    $CourseName = $_POST['CourseName'];
    $CourseDescription = $_POST['CourseDescription'];
    $LecturerID = isset($_POST['LecturerID']) ? $_POST['LecturerID'] : '';
    $LecturerName = $_POST['LecturerName'];
    $LecturerQualification = $_POST['LecturerQualification'];
    $StudyDuration = $_POST['StudyDuration'];
    $LearningPlatform = $_POST['LearningPlatform'];
    $LearningResult = $_POST['LearningResult'];
    $CourseOutline = $_POST['CourseOutline'];

    do {
        //check if any of the course information is empty
        if (empty($CourseID) || empty($CourseDescription) || empty($LecturerID) || empty($LecturerName) || empty($LecturerQualification) || empty($StudyDuration) || empty($LearningPlatform) || empty($LearningResult) || empty($CourseOutline)) {
            //if any of the course information is empty, store an error message in the error variable
            $error = "Please fill in all fields";
            break;
        }
        //update the course information in the database
        $sqlCourseDetail = "UPDATE coursedetail SET CourseDescription = '$CourseDescription', LecturerID = '$LecturerID', LecturerName = '$LecturerName', LecturerQualification = '$LecturerQualification', StudyDuration = '$StudyDuration', LearningPlatform = '$LearningPlatform', LearningResult = '$LearningResult', CourseOutline = '$CourseOutline' WHERE CourseID = '$CourseID'";

        $resultCourseDetail = $conn->query($sqlCourseDetail);

        if (!$resultCourseDetail) {
            // Error updating course detail
            $error = "Error updating course detail: " . $conn->error;
        } else {
            // Update lecturer
            $sqlLecturer = "UPDATE lecturer SET CourseID = '$CourseID', CourseName = '$CourseName' WHERE LecturerID = '$LecturerID'";

            $resultLecturer = $conn->query($sqlLecturer);

            $sqlLecturerDetail = "UPDATE lecturerdetail SET CourseID = '$CourseID', CourseName = '$CourseName' WHERE LecturerID = '$LecturerID'";
            $resultLecturerDetail = $conn->query($sqlLecturerDetail);
            if (!$resultLecturer && !$resultLecturerDetail) {
                // Error updating lecturer
                $error = "Error updating lecturer: " . $conn->error;
            } else {
                // Both updates were successful
                $success = "Course Details updated successfully";
                header("location: CourseDetail.php");
                exit;
            }
        }
    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container my-5">
        <h2>Edit Course Detail</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="CourseID" value="<?php echo $CourseID; ?>">
            <input type="hidden" name="CourseName" value="<?php echo $CourseName; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="CourseName" value="<?php echo $CourseName; ?>"
                        disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Description</label>
                <div class="col-sm-6">
                    <textarea type="text" class="form-control"
                        name="CourseDescription"><?php echo $CourseDescription; ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Lecturer Name</label>
                <div class="col-sm-6">
                    <select type="text" class="form-control" name="LecturerID" id="LecturerID">
                        <?php
                        //Create a query to select all the categories from the coursecategory table
                        $query1 = "SELECT LecturerID, LecturerName, LecturerQualification FROM lecturer";
                        //Execute the query and store the result in the $result1 variable
                        $result1 = mysqli_query($conn, $query1);

                        //Check if the query was successful
                        if (mysqli_num_rows($result1) > 0) {
                            //Echo an option element with the category ID and name as the value and text respectively
                            echo "<option value='0' selected disabled>Please Select Lecturer</option>";
                            while ($row = mysqli_fetch_assoc($result1)) {
                                $Lecturer_ID = $row['LecturerID'];
                                $Lecturer_Name = $row['LecturerName'];
                                $Lecturer_Qualification = $row['LecturerQualification'];
                                echo "<option value='$Lecturer_ID' data-qualification='$Lecturer_Qualification'>$Lecturer_Name</option>";
                            }
                        } else {
                            // If no lecturer found
                            echo "<option value='0'>No Lecturer Found</option>";
                        }

                        ?>
                    </select>
                    <input type="hidden" name="LecturerName" id="LecturerName" value="<?php echo $Lecturer_Name ?>">
                    <input type="hidden" name="LecturerQualification" id="LecturerQualification"
                        value="<?php echo $Lecturer_Qualification ?>">
                </div>
            </div>

            <script>
                // Fetch qualification based on lecturer selection
                document.getElementById('LecturerID').addEventListener('change', function () {
                    var selectedIndex = this.selectedIndex;
                    var selectedOption = this.options[selectedIndex];
                    var lecturerName = selectedOption.text;
                    var lecturerQualification = selectedOption.getAttribute('data-qualification');

                    document.getElementById('LecturerName').value = lecturerName;
                    document.getElementById('LecturerQualification').value = lecturerQualification;
                }); 
            </script>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Study Duration (Year)</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="StudyDuration" value="<?php echo $StudyDuration; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Learning Platform</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="LearningPlatform"
                        value="<?php echo $LearningPlatform; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Learning Result</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="LearningResult"
                        value="<?php echo $LearningResult; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Course Outline</label>
                <div class="col-sm-6">
                    <textarea type="text" class="form-control" name="CourseOutline"><?php echo $CourseOutline; ?></textarea>
                </div>
            </div>

            <?php
            if (!empty($success)) {
                echo "
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$success</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }

            if (!empty($error)) {
                echo "
                <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$error</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="AddCourse">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="CourseDetail.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>