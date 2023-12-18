<?php
if (isset($_GET['CartID'])) {
    include '../ConnectDB.php';
    $id = $_GET['CartID'];

    $sql = "DELETE FROM shoppingcart WHERE CartID = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: ShoppingCart.php');
        exit;
    }
}
?>