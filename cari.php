<?php
include 'config.php';
session_start();

if(isset($_GET['asal']) && isset($_GET['tujuan']) && isset($_GET['waktu'])){
    $asal = strtolower($_GET['asal']);
    $tujuan = strtolower($_GET['tujuan']);
    $waktu = $_GET['waktu'];
    $sql = "SELECT * FROM jadwal WHERE asal = '$asal' AND tujuan = '$tujuan' AND berangkat LIKE '$waktu%'";
    $result = $conn->query($sql);
    

}else{
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body style="background-image: url('img/main.jpg'); background-size:cover; background-position: center; background-repeat: no-repeat;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-info" href="index.php">T-SAT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-8">
                <h4><a class="text-decoration-none text-dark" href="index.php"><span class="fa-solid fa-arrow-left"></span> Back</a></h4>
                <?php
                if(isset($_GET['asal']) && isset($_GET['tujuan']) && isset($_GET['waktu'])){
                    $tanggal =  date("l, d-M-Y",strtotime($waktu));
                    echo "<h2>$asal ke $tujuan</h2>";
                    echo "<h2 class='mb-4'><i class='fa-solid fa-calendar'></i> $tanggal</h2>";
                }
                    
                    
                ?>

                <div class="table-responsive">
                    <table class="table table-success table-striped mb-4 border border-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Maskapai</th>
                                <th scope="col">Berangkat</th>
                                <th scope="col">Tiba</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>  
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            if($result->num_rows > 0){
                                $i = 1;
                                while($hasil = mysqli_fetch_array($result)){
                                    $maskapai = $hasil['maskapai'];
                                    $id = $hasil['id'];
                                    echo "<tr>";
                                    echo "<td>$i </td>";
                                    $sql2 = "SELECT nama FROM maskapai WHERE id = $maskapai";
                                    $hasil2 = mysqli_fetch_assoc($conn->query($sql2));
                                    foreach($hasil2 as $hsl){
                                        echo "<td>".$hsl."</td>";
                                    }
                                    echo "<td>".$hasil['berangkat']."</td>";
                                    echo "<td>".$hasil['tiba']."</td>";
                                    echo "<td> Rp ".$hasil['harga']."</td>";
                                    echo "<td><a class='btn btn-success' href='tiket-amount.php?id=$id'><span class='fa-solid fa-circle-check'></span> Beli</a></td>";
                                    echo "</tr>";
                                    $i++;
                                }
                                
                            }else{
                                echo "<script>alert('Tidak ada tiket yang ditemukan!');</script>";
                                echo "<tr><td colspan='6' class='text-center'>No Ticket Found!</td></tr>";
                            }   
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</html>