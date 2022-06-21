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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid bg-dark">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none bg-dark">
                    <span class="fs-5 d-none d-sm-inline">Dashboard</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li>
                        <a href="#" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Home</span> </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Tambah</span> </a>
                        <ul class="collapse hide nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="tambah-jadwal.php" class="nav-link px-0"> Jadwal Keberangkatan</a>
                            </li>
                            <li>
                                <a href="tambah-maskapai.php" class="nav-link px-0"> Maskapai</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <!-- <img src="" width="30" height="30" class="rounded-circle"> -->
                        <span class="d-none d-sm-inline mx-1">Admin</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3 bg-info">
            <h3>Welcome Admin!</h3>
            <div style="padding-top: 100px;">
            <h4>Jadwal</h4>
                <table class="table table-success table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Maskapai</th>
                            <th scope="col">Asal</th>
                            <th scope="col">Tujuan</th>
                            <th scope="col">Berangkat</th>
                            <th scope="col">Tiba</th>
                            <th scope="col">Kapasitas</th>
                            <th scope="col">Tersedia</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = "SELECT * FROM jadwal";
                        $result = $conn->query($query);
                        $rows = array();
                        $i = 1;
                        while($row = mysqli_fetch_array($result)){
                            
                            $rows[] = $row;
                            echo "<tr>";
                            echo "<td>$i </td>";
                            echo "<td>".$row['maskapai']."</td>";
                            echo "<td>".$row['asal']."</td>";
                            echo "<td>".$row['tujuan']."</td>";
                            echo "<td>".$row['berangkat']."</td>";
                            echo "<td>".$row['tiba']."</td>";
                            echo "<td>".$row['kapasitas']."</td>";
                            echo "<td>".$row['tersedia']."</td>";
                            echo "</tr>";
                            $i++;
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