<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        @media (min-width: 1025px) {
            .h-custom {
                height: 100vh !important;
            }
        }
    </style>
</head>

<body>
    <section class="h-100 h-custom">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <h1 style="text-align: center;">Shopping Cart</h1>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>Product ID</td>
                                    <td>Product Name</td>
                                    <td>Product Type</td>
                                    <td>Price</td>
                                    <td>Operating</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include '../ConnectDB.php';
                                include '../Session.php';

                                $sql = "SELECT * FROM `shoppingcart` WHERE `UserID` = '$userID'";
                                $result = $conn->query($sql);
                                $counter = 1;
                                $totalPrice = 0;
                                while ($row = $result->fetch_assoc()) {
                                    echo " <tr>
                                            <td>{$counter}</td>
                                            <td>{$row['CourseName']}</td>
                                            <td>{$row['CategoryName']}</td>
                                            <td>RM {$row['CoursePrice']}</td>
                                            <td>
                                                <a href='cart-delete.php?CartID={$row['CartID']}' class='btn btn-danger btn-sm'>Delete</a>
                                            </td>
                                        </tr>";
                                    $totalPrice += $row['CoursePrice'];
                                    $counter++;
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>

                    <div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px;">
                        <div class="card-body p-4">

                            <div class="row" style="padding: 10px;">
                                <div class="col-md-6 col-lg-4 col-xl-3 mb-4 mb-md-0">
                                    <form>
                                        <div class="d-flex flex-row pb-3">
                                            <div class="d-flex align-items-center pe-2">
                                                <input class="form-check-input" type="radio" name="radioNoLabel"
                                                    id="radioNoLabel1v" value="" aria-label="..." checked />
                                            </div>
                                            <div class="rounded border w-100 p-3">
                                                <p class="d-flex align-items-center mb-0">
                                                    <i class="fab fa-cc-mastercard fa-2x text-dark pe-2"></i>Credit
                                                    Card
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row pb-3">
                                            <div class="d-flex align-items-center pe-2">
                                                <input class="form-check-input" type="radio" name="radioNoLabel"
                                                    id="radioNoLabel2v" value="" aria-label="..." />
                                            </div>
                                            <div class="rounded border w-100 p-3">
                                                <p class="d-flex align-items-center mb-0">
                                                    <i class="fab fa-cc-visa fa-2x fa-lg text-dark pe-2"></i>Debit Card
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row">
                                            <div class="d-flex align-items-center pe-2">
                                                <input class="form-check-input" type="radio" name="radioNoLabel"
                                                    id="radioNoLabel3v" value="" aria-label="..." />
                                            </div>
                                            <div class="rounded border w-100 p-3">
                                                <p class="d-flex align-items-center mb-0">
                                                    <i class="fab fa-cc-paypal fa-2x fa-lg text-dark pe-2"></i>PayPal
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-6">

                                </div>
                                <div class="col-lg-4 col-xl-3">
                                    <div class="d-flex justify-content-between" style="font-weight: 500;">
                                        <p class="mb-2">Subtotal</p>
                                        <p class="mb-2">RM
                                            <?php echo "$totalPrice" ?>
                                        </p>
                                    </div>

                                    <?php
                                    $Tax = $totalPrice * 0.05;
                                    $Total = $totalPrice + $Tax;
                                    ?>
                                    <div class="d-flex justify-content-between" style="font-weight: 500;">
                                        <p class="mb-0">Service Fee</p>
                                        <p class="mb-0">RM
                                            <?php echo "$Tax" ?>
                                        </p>
                                    </div>

                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                                        <p class="mb-2">Total (tax included)</p>
                                        <p class="mb-2">RM
                                            <?php echo "$Total" ?>
                                        </p>
                                    </div>

                                    <button type="button" class="btn btn-primary btn-block btn-lg">
                                        <div class="d-flex justify-content-between">
                                            <span>Checkout</span>
                                            <span>RM
                                                <?php echo "$Total" ?>
                                            </span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

</body>

</html>