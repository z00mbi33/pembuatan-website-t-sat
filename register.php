<?php
require_once("config.php");

if (isset($_POST['register'])) {
    // filter data yang diinputkan
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password_1 = $_POST['password1'];
    $password_2 = $_POST['password2'];

    if ($password_1 == $password_2) {
        $password = md5($password_1);
        $sql = "INSERT INTO user (name, email, telepon, username, password) VALUES ('$name', '$email', '$phone', '$username', '$password')";
        if (mysqli_query($conn, $sql)) {
            header('location: login.php');
        } else {
            die();
        }
    }else{
        echo "<script>alert('Kedua password tidak sama!');window.location.href = 'register.php';</script>";
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

<body class="img-fluid" style="background-image: url('img/login.jpg'); background-size:cover; background-position: center; background-repeat: no-repeat;">
    <section>
        <div class="container  py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-7">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5">
                            <h3 class="mb-6 text-center">Sign Up</h3>
                            <form action="" method="POST">
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control form-control-lg" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control form-control-lg" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="email">Email Address</label>
                                    <input type="email" id="email" name="email" class="form-control form-control-lg" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input type="text" id="phone" name="phone" class="form-control form-control-lg" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" id="password" name="password1" class="form-control form-control-lg" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="password2">Confirm Password</label>
                                    <input type="password" id="password2" name="password2" class="form-control form-control-lg" required />
                                </div>

                                <div class="row">
                                    <a href="login.php" class="btn col btn-danger btn-lg btn-block me-4"><span class="fa-solid fa-xmark"></span> Cancel    </a>
                                    <button class="btn col btn-primary btn-lg btn-block" type="submit" name="register">Register</button>
                                </div>

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