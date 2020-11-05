<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact - TKM Drive Online</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="./js/JavaS.js"></script>
    <link rel="stylesheet" href="./css/homedrive.css">
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
                <a class="nav-link" href="drive.php">Services</a>
                </li>
                <li class="nav-item active">
                <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <img style="width: 100%; height: 100%;"src="./images/contact.jpg">
    
	<!--Footer-->
    <?php
        require_once('tmp/footer.php')
    ?>
</body>
</html>