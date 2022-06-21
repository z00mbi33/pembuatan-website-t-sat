<?php
session_start();
if (!isset($_SESSION['username'])){
    echo "<script>if(confirm('Silahkan login terlebih dahulu')){document.location.href='login.php'};</script>";
}


if (isset($_SESSION['role'])) {
    if($_SESSION['role']==0){
        echo "<a class='dropdown-item' href='dashboard.php'>Dashboard</a>";
    }
}
?>

<a class="dropdown-item" href="logout.php">Sign out</a>