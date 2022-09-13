<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scan";
$id = $_GET['id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE resi SET status=0 WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data berhasil dihapus');</script>";
} else {
    echo "<script>alert('Data gagal dihapus');</script>";
    echo "Error updating record: " . $conn->error;
}

$conn->close();
echo "<script>window.location = './'</script>";
