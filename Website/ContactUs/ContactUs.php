<?php
include 'find-user.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header class="headerpage"></header>
    <section>
        <div class="container mt-5">
            <h3 class="heading mb-4">Contact us</h3>
            <div class="row g-4">
                <div class="col p-3 m-1" style="border: 1px solid black; border-radius: 5%">
                    <form action="insert.php" method="post">
                        <input type="hidden" name="UserID" id="UserID"
                            value="<?php echo isset($userID) ? $userID : ''; ?>">
                        <div class="mb-3">
                            <label for="UserName" class="form-label">Your name</label>
                            <input type="text" class="form-control" id="UserName" name="UserName" placeholder="Name..."
                                value="<?php echo isset($name) ? $name : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="ContactNumber" class="form-label">Your phone number</label>
                            <input type="text" class="form-control" id="ContactNumber" name="ContactNumber"
                                placeholder="Phone..." value="<?php echo isset($phone) ? $phone : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="Email" class="form-label">Your email address</label>
                            <input type="email" class="form-control" id="Email" name="Email" placeholder="E-mail..."
                                value="<?php echo isset($email) ? $email : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="Message" class="form-label">Your message</label>
                            <textarea class="form-control" id="Message" name="Message"
                                placeholder="How can we help you?" required></textarea>
                        </div>
                        <input type="hidden" name="replyStatus" value="Waiting Reply">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary px-4">Send</button>
                        </div>
                    </form>
                </div>
                <div class="col p-3 m-1 bg-light">
                    <div class="contactus-question">
                        <h1>Have a question for us?</h1>
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="card p-3">
                                    <h5 class="card-title"><ins>Account & notifications</ins></h5>
                                    <p class="card-text">If you have trouble logging in or need to change your account
                                        settings (such as your name, email address, or password)</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card p-3">
                                    <h5 class="card-title"><ins>Privacy query</ins></h5>
                                    <p class="card-text">If you have questions about our privacy statement or have
                                        questions about how we protect your personal information, you can contact us at
                                        <a href="">email</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card p-3">
                                    <h5 class="card-title"><ins>Industry Partnership Inquiries</ins></h5>
                                    <p class="card-text">If you’re a university interested in creating Professional
                                        Certificates on our platform, please contact us <a href="">here</a>.</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card p-3">
                                    <h5 class="card-title"><ins>Refund policies</ins></h5>
                                    <p class="card-text">If you decide not to complete a course or specialization you
                                        paid for, we may be able to refund your payment.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="footerpage"></footer>
    <script>
        $(function () {
            $(".headerpage").load("../Header.html");
            $(".footerpage").load("../Footer.html");
        });
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>