<?php
include "connect.php";

try{
    $id = $_POST['id'];
    $medicineName = $_POST['medicineName'];
    $quantity = $_POST['quantity'];
    $unitPrice = $_POST['unitPrice'];
    $expiryDate = $_POST['expiryDate'];
    
    // Check if expiryDate is empty, if not, include it in the SQL query
    if (!empty($expiryDate)) {
        $sql = "UPDATE medicines SET medicineName='$medicineName', availableMedicines = $quantity,  quantity=$quantity, unitPrice=$unitPrice, totalPrice=$quantity * $unitPrice, expiryDate='$expiryDate' WHERE id=$id";
    } else {
        $sql = "UPDATE medicines SET medicineName='$medicineName', quantity=$quantity, availableMedicines=$availableMedicines, purchasedMedicines=$purchasedMedicines WHERE id=$id";
    }
    
    if ($connection->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $connection->error;
    }
    
    $connection->close();
    
}
catch (Exception $e){
    echo $e->getMessage();
}
?>
