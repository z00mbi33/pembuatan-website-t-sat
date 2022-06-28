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
    $query = "SELECT * FROM jadwal WHERE id = $id";
    $result = $conn->query($query);
    $hasil = mysqli_fetch_assoc($result);
}

if (isset($_POST['submit'])) {
    $maskapai = $_POST['maskapai'];
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];
    $berangkat = $_POST['berangkat']." ".$_POST['berangkat_waktu'];
    $tiba = $_POST['tiba']." ".$_POST['tiba_waktu'];
    $harga = $_POST['harga'];
    $kapasitas = $_POST['kapasitas'];
    $tersedia = $_POST['tersedia'];

    $sql = "UPDATE jadwal SET maskapai='$maskapai', asal='$asal', tujuan='$tujuan', 
    berangkat='$berangkat', tiba='$tiba', harga='$harga', kapasitas='$kapasitas', tersedia='$tersedia' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Ubah data berhasil!');window.location.href = 'dashboard.php';</script>";
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
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="background-color: #0ACDF8;">
    <section>
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-10">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5">
                            <a href="dashboard.php" class="btn btn-primary btn-lg btn-block"><span class="fa-solid fa-arrow-left"></span> back</a>
                            <h3 class="mb-6 text-center">Ubah Jadwal Keberangkatan</h3>
                            <form action="" method="POST">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="asal">Maskapai</label>
                                    <select class="form-select" name="maskapai" required>
                                        <option value="" selected disabled>Pilih maskapai</option>
                                        <?php
                                        $query = "SELECT * FROM maskapai";
                                        $result = $conn->query($query);
                                        while($row = $result->fetch_array()){
                                            $id = $row['id'];
                                            $nm_maskapai = $row['nama'];
                                            echo '<option value="'.$id.'" '.($id==$hasil['maskapai']?" selected":"").' 
                                            >'.$id.' - '.$nm_maskapai.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="asal">Asal</label>
                                    <input type="text" id="asal" name="asal" value="<?= $hasil['asal'] ?>" class="form-control form-control-lg" required/>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="tujuan">Tujuan</label>
                                    <input type="text" id="tujuan" name="tujuan"  value="<?= $hasil['tujuan'] ?>" class="form-control form-control-lg" required/>
                                </div>

                                <div class="row">
                                    <div class="form-outline col mb-4">
                                        <label class="form-label" for="berangkat">Berangkat (tanggal)</label>
                                        <input type="date" id="berangkat" name="berangkat" value="<?= date("Y-m-d",strtotime($hasil['berangkat'])) ?>" class="form-control form-control-lg" required/>
                                    </div>
                                    <div class="form-outline col mb-4">
                                        <label class="form-label" for="tiba">Berangkat (waktu)</label>
                                        <input type="time" id="berangkat_waktu" name="berangkat_waktu" value="<?= date("H:i",strtotime($hasil['berangkat'])) ?>" class="form-control form-control-lg" required/>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="form-outline col mb-4">
                                        <label class="form-label" for="tiba">Tiba (tanggal)</label>
                                        <input type="date" id="tiba" name="tiba" value="<?= date("Y-m-d",strtotime($hasil['tiba'])) ?>" class="form-control form-control-lg" required/>
                                    </div>
                                    <div class="form-outline col mb-4">
                                        <label class="form-label" for="tiba">Tiba (waktu)</label>
                                        <input type="time" id="tiba_waktu" name="tiba_waktu" value="<?= date("H:i",strtotime($hasil['tiba'])) ?>" class="form-control form-control-lg" required/>
                                    </div>
                                </div>
                                
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="harga">Harga</label>
                                    <input type="text" id="harga" name="harga" value="<?= $hasil['harga'] ?>" class="form-control form-control-lg" required/>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="kapasitas">Kapasitas</label>
                                    <input type="text" id="kapasitas" name="kapasitas" value="<?= $hasil['kapasitas'] ?>" class="form-control form-control-lg" required/>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="tersedia">Tersedia</label>
                                    <input type="text" id="tersedia" name="tersedia" value="<?= $hasil['tersedia'] ?>" class="form-control form-control-lg" required/>
                                </div>

                                <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Ubah</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</html>