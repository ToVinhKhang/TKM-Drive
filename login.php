<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - TKM Drive Online</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="./js/JavaS.js"></script>
    <link rel="stylesheet" href="./css/login.css">
    <link rel='icon' type="image/png" sizes="16x16" href="./images/logoTKM.png">
</head>

<body>
    <!--Header-->
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <img src="./images/logoTKM.png" style="width: 42px; height: 42px;">
        <a class="navbar-brand" href="home.php">&nbsp;&nbsp;TKM Drive Online</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="aboutus.php">About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="login.php">Services</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <!--Login-->
    <?php
        require_once('config.php');
        $pwd = filter_input(INPUT_POST, 'pwd',FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_STRING);
        if($pwd && $email){
            if(Login($email,$pwd)==true){
                $_SESSION['email']=$email;
                redirect('/TKMDrive/drive.php');
            }
            else{
                setShowMess('Your email or password is not correct');
            }
        }
    ?>
    <!--Logout-->
    <?php
        if(isset($_POST['logout'])){
            unset($_SESSION['email']);
        }
    ?>

    <br><br><br><br>
    <div class="container">
        <form action="" onsubmit="return CheckInput()" method="POST">
            <h2>Login</h2>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" onclick="ClearErrorMess()" class="form-control" id="email" placeholder="Enter your email" name="email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" onclick="ClearErrorMess()" class="form-control" id="pwd" placeholder="Enter your password" name="pwd">
            </div>
            <p id="ErrorMess"></p>
            <button type="submit" class="btn btn-dark">Login</button>
            <a href='signup.php' style='text-align: center;'>Create an account</a>

        </form>
    </div>
    <br><br><br><br>
    <?php
        $mess = getShowMess();
        if($mess){
            ?>
            <div id='error' class="alert alert-danger" style="width: 500px; text-align: center; margin: auto;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span id=errorContent><?= $mess ?></span>
            </div>
            <br><br>
            <?php
        }
    ?>

</body>
</html>
