<?php
include 'find-index.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Resume</title>
    <link rel="stylesheet" type="text/css" href="UserResume.css">
</head>

<body>
    <div class="container-upper">
        <div class="container-right">
            <button onclick="window.location.href='../UserProfile/UserProfile.php'"
                script="window.location.replace('../UserProfile/UserProfile.php')">Profile</button>
            <button>Resume</button>
            <button onclick="window.location.href='../UserHistory/UserHistory.html'"
                script="window.location.replace('../UserHistory/UserHistory.html')">History</button>
        </div>
    </div>
    <img src="<?php echo $image; ?>" alt="User Image" class="user-img">
    <div class="container-lower">
        <button class="edit-profile"
            onclick="document.getElementById('id01').style.display='block'; document.getElementById('fileInput').click()">Edit
            Profile</button>
        <div class="container-content">
            <h1>Experience</h1>
            <div>
                <?php echo $experience; ?>
            </div>
            <h1>Education</h1>
            <div>
                <?php echo $education; ?>
            </div>
            <div>
                <h1>Professional Skillset</h1>
                <ul id="skillsetList">
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

                <h1>Language</h1>
                <ul id="languageList">
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
            </div>
        </div>
        <div id="id01" class="modal">
            <form class="modal-content animate" action="insert-index.php" method="post" enctype="multipart/form-data">
                <div class="imgcontainer">
                    <span onclick="document.getElementById('id01').style.display='none'" class="close"
                        title="Close Modal">&times;</span>
                </div>
                <div class="container">
                    <label for="Experience"><b>Experience</b></label>
                    <input type="text" placeholder="Enter Your Work Experience" name="Experience" id="Experience"
                        value="<?php echo $experience; ?>">
                    <label for="Education"><b>Education</b></label>
                    <input type="text" placeholder="Enter Your Education" name="Education" id="Education"
                        value="<?php echo $education; ?>">

                    <label for="Skillset"><b>Professional Skillset (Branch via '/'. Example - a/b)</b></label>
                    <input type="text" placeholder="Enter Your Professional Skillset" name="Skillset" id="Skillset"
                        value="<?php echo $skillset; ?>">

                    <label for="Language"><b>Language (Branch via '/'. Example - a/b)</b></label>
                    <input type="text" placeholder="Enter Your Language" name="Language" id="Language"
                        value="<?php echo $language; ?>">

                    <button type="submit" name="save"
                        style="width: 20rem; height: 5rem; border: none; background-color: rgb(255, 140, 0);">Save</button>
                </div>
            </form>
        </div>
    </div>
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
</body>

</html>