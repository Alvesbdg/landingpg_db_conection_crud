<?php
include 'db_connect.php';
// Ambil data dari form
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Siapkan dan jalankan query SQL
$sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan!";
 //   header("Location: index.html");

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
