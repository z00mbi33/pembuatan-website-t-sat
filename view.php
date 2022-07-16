<?php
include 'config.php';
session_start();


if (!isset($_GET['id'])) {
    header("Location: index.php");
} else {
    $id = $_GET['id'];
    $query = "SELECT * FROM tiket where id = $id";
    $result = mysqli_fetch_assoc($conn->query($query));

    $userid = $result['user_id'];
    $userquery = "SELECT * FROM user where id = $userid";
    $userdata = mysqli_fetch_assoc($conn->query($userquery));

    $jadwalid = $result['jadwal_id'];
    $jadwalquery = "SELECT * FROM jadwal where id = $jadwalid";
    $jadwaldata = mysqli_fetch_assoc($conn->query($jadwalquery));
    $tanggal =  date("d M y", strtotime($jadwaldata['berangkat']));
    $jam = date("H:i", strtotime($jadwaldata['berangkat']));

    $maskapaiid = $jadwaldata['maskapai'];
    $maskapaiquery = "SELECT * FROM maskapai where id = $maskapaiid";
    $maskapaidata = mysqli_fetch_assoc($conn->query($maskapaiquery));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"> </script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"> </script>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #print,
            #print * {
                visibility: visible;
            }

            #print {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>

<body class="vh-100" style="background-image: url('img/main.jpg'); background-size:cover; background-position: center; background-repeat: no-repeat;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-info" href="index.php">T-SAT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <?php
                        if (isset($_SESSION['username'])) {
                        ?>
                            <a class="navbar-brand dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            echo $_SESSION['username'];
                        } else {
                            echo "<a class='nav-link' href='login.php'>Login</a>";
                        }
                            ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php
                                if (isset($_SESSION['role'])) {
                                    if ($_SESSION['role'] == 0) {
                                        echo "<a class='dropdown-item' href='dashboard.php'>Dashboard</a>";
                                        echo "<hr>";
                                    } else {
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
    <div class="container mt-2">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-9">
                <h4><a class="text-decoration-none text-dark" href="profile.php"><span class="fa-solid fa-arrow-left"></span> Back</a></h4>
                <div class="card shadow-2-strong text-dark border border-dark rounded-3">
                    <div class="card-body p-4">
                        <div class="container mb-2" id="print">
                            <div class="container" >
                                <h3 class="mb-4 border-bottom border-dark"><i class="fa-solid fa-plane"></i> TSAT</h3>
                                <div class="row">
                                    <h5 class="col-6">Nama Penumpang</h5>
                                    <h5 class="col-6">Jumlah</h5>
                                </div>

                                <div class="row mb-2">
                                    <p class="col-6 text-capitalize"><?= $userdata['name'] ?></p>
                                    <p class="col-6"><?= $result['jumlah'] ?></p>
                                </div>

                                <div class="row">
                                    <h5 class="col-3">Dari</h5>
                                    <h5 class="col-3">Maskapai</h5>
                                    <h5 class="col-3">Tanggal</h5>
                                    <h5 class="col-3">Waktu</h5>
                                </div>

                                <div class="row mb-2">
                                    <p class="col-3 text-capitalize"><?= $jadwaldata['asal'] ?></p>
                                    <p class="col-3 text-capitalize"><?= $maskapaidata['nama'] ?></p>
                                    <p class="col-3 text-capitalize"><?= $tanggal ?></p>
                                    <p class="col-3 text-capitalize"><?= $jam ?></p>
                                </div>

                                <div class="row">
                                    <h5>Ke</h5>
                                </div>

                                <div class="row mb-2">
                                    <p class="text-capitalize"><?= $jadwaldata['tujuan'] ?></p>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4">
                                <a class="btn btn-success btn-lg btn-block form-control form-control-lg" onclick="doCapture()" href="#"><i class="fa-solid fa-image"></i> Simpan Tiket</a>
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


<script>
    function doCapture() {
        window.scrollTo(0, 0);

        // Convert the div to image (canvas)
        html2canvas(document.getElementById("print")).then(function(canvas) {
            var a = document.createElement('a');
            a.href = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
            a.download = 'tiket_saya.jpg';
            a.click();
        });

    }
</script>

</html>