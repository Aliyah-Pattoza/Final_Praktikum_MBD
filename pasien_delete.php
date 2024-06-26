<?php
include 'db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "CALL deletePatientAndRelatedData($id)";

    if ($conn->query($sql) === TRUE) {
        echo "Data pasien dan data terkait berhasil dihapus";
        header("Location: pasien.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
