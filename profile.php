<?php
include 'config.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
} else {
    $userid = $_SESSION['id'];
    $query = "SELECT * FROM tiket where user_id = $userid";



?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body class="vh-100" style="background-image: url('img/main.jpg'); object-fit:fill; background-size:cover; background-position: center center; background-repeat: no-repeat;">
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
        <div class="container-fluid mt-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-8">
                    <div class="card opacity-75 shadow-2-strong text-dark border border-dark rounded-3">
                        <div class="card-body p-5 ">
                            <h3 class="mb-4 border-bottom border-dark">Tiket Saya</h3>
                            <div class="container-fluid m-auto">
                                <table class="table table-striped border border-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result = mysqli_query($conn, $query)) {
                                            if ($result->num_rows > 0) {
                                                $no = 1;
                                                while($hasil = mysqli_fetch_array($result)){
                                                    $id = $hasil['id'];
                                                    $tanggal = $hasil['created_at'];
                                                    $jumlah = $hasil['jumlah'];
                                                    echo"<tr>";
                                                    echo "<td>$no</td>";
                                                    echo "<td>$tanggal</td>";
                                                    echo "<td>$jumlah</td>";
                                                    echo "<td><a class='btn btn-success' href='view.php?id=$id'><span class='fa-solid fa-eye'></span> View</a>";
                                                    echo"</tr>";
                                                    ++$no;
                                                }
                                            } else {
                                                echo "<tr><td class='text-center' colspan='3'>Anda belum melakukan pemesanan</td></tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
} ?>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    </html>