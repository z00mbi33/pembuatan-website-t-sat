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
    <title>Tambah Maskapai</title>
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
                            <h3 class="mb-6 text-center">Tambah Maskapai</h3>
                            <form action="" method="POST">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="name">Maskapai</label>
                                    <input type="text" id="name" name="name" class="form-control form-control-lg" required/>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="username">Asal</label>
                                    <input type="text" id="username" name="username" class="form-control form-control-lg" required/>
                                </div>

                                <button class="btn btn-primary btn-lg btn-block" type="submit" name="register">Tambah</button>

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