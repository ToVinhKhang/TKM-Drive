<?php
    require_once('config.php');
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <title>Memories - TKM Drive Online</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel ="stylesheet" href="./css/homedrive.css"/>
    <link rel='icon' type="image/png" sizes="16x16" href="./images/logoTKM.png">
    <script src="./js/JavaS.js"></script>
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
                <li class="nav-item active">
                <a class="nav-link" href="login.php">Services</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Get info from login -->
    <?php
        if(!isset($_SESSION['email'])){
            redirect('/TKMDrive/login.php');
        }
        $nick = $_SESSION['email'];
    ?>

    <br>
    <a id="loginuser"><i><b><?= $nick ?></b></a>
    <br>

    <a id="loginuser"></i><img src="./images/user.png" width="60" height="60" alt="user">&thinsp;</a>
    <form action='login.php' method='POST'>
        <button type="submit" class="btn btn-link" id="loginuser" name='logout'>Đăng xuất</button>
    </form>

    <div>
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <h4><img src="./images/plus.png" width="40" height="40" alt="plus icon">&thinsp;Thêm mới</h4>
                    <p></p>
                    <input type="file" name="MyFile" id="MyFile">
                    <p></p>
                    <input type="hidden" name="submit" >
                    <button type="submit" name='clickUp' class="btn btn-info " onclick=" return <?= $_SESSION['OverloadMemories'] ?>">Tải lên</button>
                    <p></p>
                </form>

                <input class="form-control" type="text" name="searching" placeholder="Search...">
                <br>
            
                <nav class="navbar navbar-light ">
                    <ul id="ulmenu" class="navbar-nav nav nav-pills">
                        <li id="menu" class="nav-item"><a class="nav-link" href="drive.php">TKMDrive của tôi</a></li>
                        <div class="dropdown-divider"></div>
                        <li id="menu" class="nav-item"><a class="nav-link" href="share.php">Được chia sẻ với tôi</a></li>
                        <div class="dropdown-divider"></div>
                        <li id="menu" class="nav-item"><a class="nav-link" href="notestar.php">Gắn dấu sao</a></li>
                        <div class="dropdown-divider"></div>
                        <li id="menu" class="nav-item"><a class="nav-link" href="trash.php">Thùng rác</a></li>
                        <div class="dropdown-divider"></div>
                        <li id="menu" class="nav-item"><a class="nav-link" href=""><b>Bộ nhớ</b></a></li>
                        <br>
                    </ul>
                </nav>
            </div>


            <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
                <h4><img src="./images/datamemoriesicon.png" width="40" height="40" alt="folder icon">&thinsp;&thinsp;Bộ Nhớ</h4>
                <div>
                    <img src="./images/cloudicon.svg"  id='imgCloud' alt="memory icon" align="right">
                    <br><br><br><br><br><br><br>

                    <!-- Show Memories --> 
                    <h1 style='text-align: center; font-size: 100px;' >
                        <?php
                            if(isset($_SESSION['memory'])){
                                if($_SESSION['memory'] < 1000){
                                    echo $_SESSION['memory'].' MB';
                                }
                                else{
                                    echo round($_SESSION['memory']/1000.0,2).' GB';
                                }
                                
                            }
                        ?>
                        / 3GB
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <!--Footer-->
    <?php
        require_once('tmp/footer.php')
    ?>
</body>
</html>