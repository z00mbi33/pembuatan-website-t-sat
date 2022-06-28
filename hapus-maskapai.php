<?php
include 'config.php';
session_start();
if (isset($_SESSION['role'])) {
    if($_SESSION['role']==1){
        header("Location: index.php");
    }
}elseif(!isset($_SESSION['role'])){
    header("Location: login.php");
}


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM maskapai WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        mysqli_query($conn, "DELETE from jadwal WHERE maskapai = $id");
        echo "Error description: " . mysqli_error($conn);
        echo "<script>alert('Hapus data berhasil!');window.location.href = 'dashboard.php';</script>";
    } else {
        die();
    }
} else {
    header("Location: dashboard.php");
}
?>