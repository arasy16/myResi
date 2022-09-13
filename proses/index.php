<?php
session_start();

$inputEmail = $_POST["email"];
$inputPassword = $_POST["password"];

// Akun admin
$adminEmail = "developer@ipec.co.id";
$adminPassword = "12345678";

if ($inputEmail == $adminEmail && $inputPassword == $adminPassword) {
    $_SESSION["email"] = $inputEmail;
    echo "
    
    <script>
        alert('Login Berhasil');
        window.location.replace('../Resi_pengiriman/');
    </script>
    
    ";
} else {
    echo "
    
    <script>
        alert('Login Gagal');
        window.location.replace('../');
    </script>

    ";
}
