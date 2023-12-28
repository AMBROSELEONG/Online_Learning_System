<?php
include '../ShoppingCart/totalSession.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FPX Check Out</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <img src="https://www.ditaselia.my/wp-content/uploads/2020/09/FPX-Logo.png" alt="FPX-Logo"
            style="width: 30%; margin: 0 35%;"></img>
        <div class="mb-3" id="totalAmount">
            <label for="total" class="form-label">Total (RM)</label>
            <input type="text" class="form-control" id="totalAmountDisplay"
                value="<?php echo isset($_SESSION['totalAmount']) ? $_SESSION['totalAmount'] : ''; ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="bankSelect" class="form-label">Bank</label>
            <select class="form-select" id="bankSelect" required>
                <option selected disabled>Select Bank</option>
                <option value="bank1">CIMB Bank</option>
                <option value="bank2">Public Bank</option>
                <option value="bank3">RHB Bank</option>
                <option value="bank4">Hong Leong Bank</option>
                <option value="bank5">AmBank Bank</option>
                <option value="bank6">UOB Bank</option>
                <option value="bank7">OCBC Bank</option>
                <option value="bank8">HSBC Bank</option>
                <option value="bank9">Bank Islam Bank</option>
            </select>
        </div>
        <div class="mb-3 d-none" id="userPasswordFields">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter Username">
        </div>
        <div class="mb-3 d-none" id="passwordFields">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter Password">
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom: 2%;" disabled
            onclick="window.location.href='../CheckOut/Progress.php'">Next</button>
        <button class="btn btn-secondary" style="width: 100%"
            onclick="window.location.href='../ShoppingCart/ShoppingCart.php'">Cancel</button>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Get the select element and the userPasswordFields and passwordFields elements
        const bankSelect = document.getElementById('bankSelect');
        const userPasswordFields = document.getElementById('userPasswordFields');
        const passwordFields = document.getElementById('passwordFields');

        // Add an event listener to the select element to check if the value is not empty
        bankSelect.addEventListener('change', function () {
            const selectedBank = bankSelect.value;
            if (selectedBank !== "") {
                // If the value is not empty, remove the d-none class from the userPasswordFields and passwordFields elements
                userPasswordFields.classList.remove('d-none');
                passwordFields.classList.remove('d-none');
            } else {
                // If the value is empty, add the d-none class to the userPasswordFields and passwordFields elements
                userPasswordFields.classList.add('d-none');
                passwordFields.classList.add('d-none');
            }
        });

        // Get the username, password and submitButton elements
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const submitButton = document.querySelector('button[type="submit"]');

        // Function to check the validity of the form
        function checkValidity() {
            // Check if the bankSelect element has a value
            const isBankSelected = bankSelect.value !== "";
            // Check if the usernameInput element has a value
            const isUsernameEntered = usernameInput.value.trim() !== "";
            // Check if the passwordInput element has a value
            const isPasswordEntered = passwordInput.value.trim() !== "";

            // Check if all the elements have a value
            const isValid = isBankSelected && isUsernameEntered && isPasswordEntered;
            // Disable the submitButton if the form is not valid
            submitButton.disabled = !isValid;
        }

        // Add an event listener to the bankSelect element to check the validity of the form
        bankSelect.addEventListener('change', checkValidity);
        // Add an event listener to the usernameInput element to check the validity of the form
        usernameInput.addEventListener('input', checkValidity);
        // Add an event listener to the passwordInput element to check the validity of the form
        passwordInput.addEventListener('input', checkValidity);

    </script>
</body>

</html>