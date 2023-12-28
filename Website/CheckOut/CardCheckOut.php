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
            <form method="post">
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
                            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
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
                    <?php
                    $error = '';
                    class Verify
                    {
                        public $email, $city, $state, $zip, $cardname, $cardnumber, $expmonth, $expyear, $cvv;

                        function email($email)
                        {
                            $verify = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";
                            if (preg_match($verify, $email)) {
                                return true;
                            } else {
                                $this->error = "Invalid email address";
                                return false;
                            }
                        }

                        function city($city)
                        {
                            $this->city = $city;
                            $verify = "/^[a-zA-Z ]*$/";
                            if (preg_match($verify, $city)) {
                                return true;
                            } else {
                                $this->error = "Invalid city";
                                return false;
                            }
                        }

                        function state($state)
                        {
                            $this->state = $state;
                            $verify = "/^[a-zA-Z ]*$/";
                            if (preg_match($verify, $state)) {
                                return true;
                            } else {
                                $this->error = "Invalid state";
                                return false;
                            }
                        }
                        function zip($zip)
                        {
                            $this->zip = $zip;
                            $verify = "/^[0-9]{5}$/";
                            if (preg_match($verify, $zip)) {
                                return true;
                            } else {
                                $this->error = "Invalid zip";
                                return false;
                            }
                        }

                        function cardname($cardname)
                        {
                            $this->cardname = $cardname;
                            $verify = "/^[a-zA-Z ]*$/";
                            if (preg_match($verify, $cardname)) {
                                return true;
                            } else {
                                $this->error = "Invalid card name";
                                return false;
                            }
                        }

                        function cardnumber($cardnumber)
                        {
                            $this->cardnumber = $cardnumber;
                            $verify = "/^[0-9]{16}$/";
                            if (preg_match($verify, $cardnumber)) {
                                return true;
                            } else {
                                $this->error = "Invalid card number";
                                return false;
                            }
                        }
                        function cvv($cvv)
                        {
                            $this->cvv = $cvv;
                            $verify = "/^[0-9]{3}$/";
                            if (preg_match($verify, $cvv)) {
                                return true;
                            } else {
                                $this->error = "Invalid cvv";
                                return false;
                            }
                        }
                        function expmonth($expmonth)
                        {
                            $this->expmonth = $expmonth;
                            $verify = '/^(January|February|March|April|May|June|July|August|September|October|November|December)$/';
                            if (preg_match($verify, $expmonth)) {
                                return true;
                            } else {
                                $this->error = "Invalid expiry month";
                                return false;
                            }
                        }
                        function expyear($expyear)
                        {
                            $this->expmonth = $expyear;
                            $verify = "/^[0-9]{4}$/";
                            if (preg_match($verify, $expyear)) {
                                return true;
                            } else {
                                $this->error = "Invalid expiry year";
                                return false;
                            }
                        }
                    }

                    if (isset($_POST['submit'])) {
                        $verify = new Verify();

                        if (
                            $verify->email($_POST['email']) &&
                            $verify->city($_POST['city']) &&
                            $verify->state($_POST['state']) &&
                            $verify->zip($_POST['zip']) &&
                            $verify->cardname($_POST['cardname']) &&
                            $verify->cardnumber($_POST['cardnumber']) &&
                            $verify->expyear($_POST['expyear']) &&
                            $verify->expmonth($_POST['expmonth']) &&
                            $verify->cvv($_POST['cvv'])
                        ) {
                            echo "<script>alert('Successfully submitted!')</script>";
                        } else {
                            $error = $verify->error;
                        }
                    }

                    // Check if there is an error message
                    if (!empty($verify->error)) {
                        echo "
                        <div class ='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>{$verify->error}</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }
                    ?>
                    <button type="submit" class="btn" id="submit" name="submit"
                        onclick="window.location.href='../CheckOut/Progress.php'">Continue to checkout</button>
                </div>
            </form>
        </div>
        <div class="col-25">
            <div class="container">
                <p>Total <span class="price" style="color:black"><b>
                            <?php echo isset($_SESSION['totalAmount']) ? $_SESSION['totalAmount'] : ''; ?>
                        </b></span></p>
            </div>
        </div>
    </div>
</body>

</html>