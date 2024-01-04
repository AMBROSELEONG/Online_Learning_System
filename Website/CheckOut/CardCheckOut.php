<?php
include '../ShoppingCart/totalSession.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>CheckOut</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial;
            font-size: 17px;
            padding: 8px;
        }

        * {
            box-sizing: border-box;
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin: 0 -16px;
        }

        .col-25 {
            -ms-flex: 25%;
            /* IE10 */
            flex: 25%;
        }

        .col-50 {
            -ms-flex: 50%;
            /* IE10 */
            flex: 50%;
        }

        .col-75 {
            -ms-flex: 75%;
            /* IE10 */
            flex: 75%;
        }

        .col-25,
        .col-50,
        .col-75 {
            padding: 0 16px;
        }

        .container {
            background-color: #f2f2f2;
            padding: 5px 20px 15px 20px;
            border: 1px solid lightgrey;
            border-radius: 3px;
        }

        input[type=text] {
            width: 100%;
            margin-bottom: 20px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        label {
            margin-bottom: 10px;
            display: block;
        }

        .icon-container {
            margin-bottom: 20px;
            padding: 7px 0;
            font-size: 24px;
        }

        .btn {
            background-color: rgb(255, 140, 0);
            color: white;
            padding: 12px;
            margin: 10px 0;
            border: none;
            width: 100%;
            border-radius: 3px;
            cursor: pointer;
            font-size: 17px;
        }

        .btn:hover {
            opacity: 0.5;
        }

        a {
            color: #2196F3;
        }

        hr {
            border: 1px solid lightgrey;
        }

        span.price {
            float: right;
            color: grey;
        }

        @media (max-width: 800px) {
            .row {
                flex-direction: column-reverse;
            }

            .col-25 {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body style="background-image: url(../img/background.jpg);">
    <h2 style="text-align: center; color: white;">Checkout</h2>
    <div class="row">
        <div class="col-75">
            <form method="post" id="checkoutForm">
                <div class="container">
                    <div class="row">
                        <div class="col-50">
                            <h3>Billing Address</h3>
                            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                            <input type="text" id="fname" name="firstname" placeholder="Full Name" required>
                            <label for="email"><i class="fa fa-envelope"></i> Email</label>
                            <input type="text" id="email" name="email" placeholder="email@example.com" required>
                            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                            <input type="text" id="adr" name="address" placeholder="No.1 Exmaple 12" required>
                            <label for="city"><i class="fa fa-institution"></i> City</label>
                            <input type="text" id="city" name="city" placeholder="Kajang" required>

                            <div class="row">
                                <div class="col-50">
                                    <label for="state">State</label>
                                    <input type="text" id="state" name="state" placeholder="Selangor" required>
                                </div>
                                <div class="col-50">
                                    <label for="zip">Zip</label>
                                    <input type="text" id="zip" name="zip" placeholder="10000" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-50">
                            <h3>Payment</h3>
                            <label for="fname">Accepted Cards</label>
                            <div class="icon-container">
                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                            </div>
                            <label for="cname">Name on Card</label>
                            <input type="text" id="cname" name="cardname" placeholder="John More Doe" required>
                            <label for="ccnum">Credit card number</label>
                            <input type="text" id="ccnum" name="cardnumber" placeholder="1111222233334444" required>
                            <label for="expmonth">Exp Month</label>
                            <input type="text" id="expmonth" name="expmonth" placeholder="September" required>
                            <div class="row">
                                <div class="col-50">
                                    <label for="expyear">Exp Year</label>
                                    <input type="text" id="expyear" name="expyear" placeholder="2018" required>
                                </div>
                                <div class="col-50">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="352" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <label>
                        <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                    </label>
                    <button type="submit" class="btn" id="submit" name="submit" disabled>Continue to checkout</button>
                </div>
            </form>
        </div>
        <div class="col-25">
            <div class="container">
                <p>Total <span class="price" style="color:black"><b>
                            <?php echo !empty($_SESSION['totalAmount']) ? $_SESSION['totalAmount'] : '0.00'; ?>
                        </b></span></p>
            </div>
        </div>
    </div>
    <script>
        let isValid = false;
        function validateEmail(email) {
            const verify = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return verify.test(email);
        }

        function validateCity(city) {
            const verify = /^[a-zA-Z ]*$/;
            return verify.test(city);
        }

        function validateState(state) {
            const verify = /^[a-zA-Z ]*$/;
            return verify.test(state);
        }

        function validateZip(zip) {
            const verify = /^[0-9]{5}$/;
            return verify.test(zip);
        }

        function validateCardname(cardname) {
            const verify = /^[a-zA-Z ]*$/;
            return verify.test(cardname);
        }

        function validateCardnumber(cardnumber) {
            const verify = /^[0-9]{16}$/;
            return verify.test(cardnumber);
        }

        function validateCvv(cvv) {
            const verify = /^[0-9]{3}$/;
            return verify.test(cvv);
        }

        function validateExpmonth(expmonth) {
            const verify = /^(January|February|March|April|May|June|July|August|September|October|November|December)$/;
            return verify.test(expmonth);
        }

        function validateExpyear(expyear) {
            const verify = /^[0-9]{4}$/;
            return verify.test(expyear);
        }

        // Function to handle form submission
        function handleSubmit(event) {
            event.preventDefault(); // Prevent default form submission

            // Retrieve form field values
            const form = document.getElementById('checkoutForm');
            const email = document.getElementById('email').value;
            const city = document.getElementById('city').value;
            const state = document.getElementById('state').value;
            const zip = document.getElementById('zip').value;
            const cardname = document.getElementById('cname').value;
            const cardnumber = document.getElementById('ccnum').value;
            const cvv = document.getElementById('cvv').value;
            const expmonth = document.getElementById('expmonth').value;
            const expyear = document.getElementById('expyear').value;

            let errorMessage = '';

            if (!validateEmail(email)) {
                errorMessage += 'Invalid email address';
            }

            if (!validateCity(city)) {
                errorMessage += 'Invalid city';
            }

            if (!validateState(state)) {
                errorMessage += 'Invalid state';
            }

            if (!validateZip(zip)) {
                errorMessage += 'Invalid zip code';
            }

            if (!validateCardname(cardname)) {
                errorMessage += 'Invalid card name';
            }

            if (!validateCardnumber(cardnumber)) {
                errorMessage += 'Invalid card number';
            }
            if (!validateCvv(cvv)) {
                errorMessage += 'Invalid CVV';
            }

            if (!validateExpmonth(expmonth)) {
                errorMessage += 'Invalid expiry month';
            }

            if (!validateExpyear(expyear)) {
                errorMessage += 'Invalid expiry year';
            }
            isValid = errorMessage === '';

            if (!isValid) {
                alert(errorMessage); // Show concatenated error messages

                // Handle marking invalid fields if needed
            }

            document.getElementById('submit').disabled = !isValid;
        }

        // Add event listener for form submission
        const form = document.getElementById('checkoutForm');
        // Function to check form validity on input change
        function checkFormValidity() {
            const inputs = form.querySelectorAll('input[required]');
            let isFormValid = true;

            inputs.forEach((input) => {
                if (input.value.trim() === '') {
                    isFormValid = false;
                }
            });

            isValid = isFormValid; // Update isValid based on form validity
            document.getElementById('submit').disabled = !isValid;
        }

        // Check form validity on input change
        form.addEventListener('input', checkFormValidity);

        // Function to handle successful form submission
        function handleSuccessfulSubmission() {
            // Redirect to progress.php
            window.location.href = 'Progress.php';
        }

        // Check for successful form submission
        form.addEventListener('submit', (event) => {
            handleSubmit(event); // Handle form submission
            if (isValid) {
                handleSuccessfulSubmission(); // If form is valid, redirect
            }
        });
    </script>

</body>

</html>