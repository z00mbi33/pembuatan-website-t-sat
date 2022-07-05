<?php
include 'config.php';
session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Silahkan login terlebih dahulu!');window.location.href = 'login.php';</script>";
}

if (isset($_GET['id']) && isset($_GET['penumpang']) && isset($_GET['maskapai'])) {
    $id = $_GET['id'];
    $maskapai = $_GET['maskapai'];
    $penumpang = $_GET['penumpang'];
    $sql = "SELECT * FROM jadwal WHERE id = '$id'";
    $result = $conn->query($sql);
    $userid = $_SESSION['id'];
} else {
    header("Location: index.php");
}

if (isset($_POST['submit'])){
    $total_byr = $_POST['total'];
    $sql2 = "INSERT INTO tiket (user_id, jadwal_id, jumlah, total_byr) VALUES ('$userid', '$id', '$penumpang', $total_byr)";
    if (mysqli_query($conn, $sql2)) {
        echo "<script>alert('Pemesanan Sukses');window.location.href = 'index.php';</script>";
    } else {
        die();
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="vh-100" style="background-image: url('img/main.jpg'); background-size:cover; background-position: center; background-repeat: no-repeat;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand  text-info" href="index.php">T-SAT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="navbar-brand dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            if (isset($_SESSION['username'])) {
                                echo $_SESSION['username'];
                            }
                            ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            if (isset($_SESSION['role'])) {
                                if ($_SESSION['role'] == 0) {
                                    echo "<a class='dropdown-item' href='dashboard.php'>Dashboard</a>";
                                    echo "<hr>";
                                }else{
                                    echo "<a class='dropdown-item' href='profile.php'>My Profile</a>";
                                    echo "<hr>";
                                }
                            }
                            ?>
                            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="opacity-75 col-12 col-md-8 col-lg-6 col-xl-8">
                <h4><a class="text-decoration-none text-dark" href="#" onclick="javascript:history.go(-1)"><span class="fa-solid fa-arrow-left"></span> Back</a></h4>
                <?php
                if (isset($_GET['id'])) {
                    $hasil = mysqli_fetch_assoc($result);
                    $asal = $hasil['asal'];
                    $tujuan = $hasil['tujuan'];
                    $tanggal =  date("D d M Y", strtotime($hasil['berangkat']));
                    $jam_brgkt = date("H:i", strtotime($hasil['berangkat']));
                    $jam_tiba = date("H:i", strtotime($hasil['tiba']));
                    $total = $penumpang * $hasil['harga'];
                }
                ?>

                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-8">
                        <div class="card shadow-2-strong rounded-2">
                            <div class="card-body p-5 ">
                            <div class="form-outline">
                                    <h4><?= $maskapai ?></h4>
                                </div>
                                <div class="form-outline">
                                    <h4><?= $tanggal ?></h4>
                                </div>
                                <form method="post" action="" name="login-form">
                                    <div class="form-outline">
                                        <?= "<h4 class='mb-2'>$jam_brgkt $asal</h4>" ?>
                                    </div>

                                    <div class="form-outline">
                                        <?= "<h4 class='mb-2'><i class='fa-solid fa-up-down'></i></h4>" ?>
                                    </div>

                                    <div class="form-outline">
                                        <?= "<h4 class='mb-4'>$jam_tiba $tujuan</h4>" ?>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <?= "<h4 class='mb-4'>Total: Rp $total ($penumpang Penumpang)</h4>" ?>
                                        <input id="total" type="text" name="total" value="<?= $total ?>" hidden>
                                    </div>

                                    <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit"><i class="fa-regular fa-square-check"></i> Konfirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</html>