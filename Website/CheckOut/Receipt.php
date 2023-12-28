<?php
include '../ConnectDB.php';
include '../ShoppingCart/totalSession.php';

$CartID = $_GET['cartIDs'];
$sql = "SELECT * FROM orders WHERE CartID = '$CartID'";
$result = $conn->query($sql);

if (!$result) {
  die("Invalid query" . $conn->error);
}

$cartIDs = isset($_GET['cartIDs']) ? explode(',', $_GET['cartIDs']) : [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Receipt</title>
  <link rel="icon" type="image/x-icon" href="../img/Logo_Icon.png">
</head>

<body>
  <script type='text/javascript'>alert('Payment Successful');</script>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="card">
          <div class="card-header text-center">
            <h4>Receipt</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <p><strong>Receipt No: </strong>
                  <?php
                  $receiptNo = rand(10000, 99999);
                  echo $receiptNo;
                  ?>
                </p>
                <p id="currentDate"><strong>Date: </strong>
                  <?php echo "{['OrderDate']}" ?>
                </p>
              </div>
            </div>
            <hr>
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Course Name</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $counter = 1;
                foreach ($cartIDs as $cartID) {
                  $sql = "SELECT * FROM orders WHERE CartID = '$cartID'";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>{$counter}</td>";
                      echo "<td>{$row['CourseName']}</td>";
                      echo "<td>{$row['CoursePrice']}</td>";
                      echo "</tr>";
                      $counter++;
                    }
                  }
                }
                ?>
              </tbody>
            </table>
            <hr>
            <div class="text-right">
              <p><strong>Total:</strong>
                <?php echo isset($_SESSION['totalAmount']) ? $_SESSION['totalAmount'] : ''; ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center" style="margin-top: 5%;">
      <button class="btn btn-primary" onclick="window.location.href='../MainPage/MainPage.php'">Continue To Buy</button>
    </div>
  </div>
  <script>
    var currentDate = new Date();

    var options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
    var formattedDate = currentDate.toLocaleDateString('en-US', options);

    document.getElementById('currentDate').innerHTML = '<strong>Date:</strong> ' + formattedDate;
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>