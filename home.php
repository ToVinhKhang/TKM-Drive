<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - TKM Drive Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel ="stylesheet" href="./css/homedrive.css"/>
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
                <li class="nav-item active">
                <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="aboutus.php">About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="drive.php">Services</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
        </div>
    </nav>


    <!--Content-->
    <br><br>
    <h1 style="text-align: center;">LƯU TRỮ DỮ LIỆU MỌI LÚC MỌI NƠI</h1>
    <h4 style="text-align: center;">Download - Upload - Share</h4>
    <p style="text-align: center;">Mọi <span style="color:#cd1417">lưu trữ trực tuyến</span> chỉ trên 1 website.</p>
    <div class="container">
        <div class="imghome">
            <img src="./images/TKMhomepage.jpg" alt="Homepage Picture">
        </div>
        <br><br><br>
        <div id="textfocus">
            <h3 >Các Chức Năng Chính</h3>
        </div>
        <div class="contenthomepage">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <ul>
                        <li><h4>Đăng tải Dữ liệu</h4></li>
                        <p>Đăng tải và chia sẻ dữ liệu trực tuyến nhanh chóng và dễ dàng.</p>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <ul>
                        <li><h4>Quản lí Dữ liệu</h4>
                        <p>Chưa bao giờ việc quản lý, theo dõi dữ liệu trở nên đơn giản đến thế.</p></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <ul>
                        <li><h4>Chia sẻ Dữ liệu</h4>
                        <p>Trao đổi thông tin dữ liệu một cách hiệu quả và bảo mật nhất.</p></li>
                    </ul>
                </div>
            </div>
            <div>
                <hr>
                <h3 style='text-align: center;'>Đặc quyền VIP từ TKM Drive</h3>
                <ul>
                    <li><h4>Lưu trữ dữ liệu lớn</h4></li>
                    <p>200GB lưu trữ sẽ được chuyển ngay vào tài khoản TKM Drive khi bạn nâng cấp lên thành viên VIP</p>
                    <li><h4>Thanh toán linh hoạt hơn</h4></li>
                <p>Đa dạng các hình thức thanh toán từ ví điện tử đến các loại thẻ ngân hàng, thẻ cào điện thoại, tin nhắn SMS</p>
                    <li><h4>Dữ liệu được bảo mật tốt nhất</h4>
                    <p>Dữ liệu lưu trữ của bạn tại tkmdrive.vn luôn được bảo mật tuyệt đối</p></li>
                </ul>
                <a href="aboutus.php" class="btn btn-dark" style="float: right;">Learn More</a>
            </div>
        </div>
        
        <br><br><br><br>
        <div id="demo" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./images/upfile.jpg" alt="Los Angeles" width="1100" height="500">
                </div>
                <div class="carousel-item">
                    <img src="./images/sharefile.jpg" alt="Chicago" width="1100" height="500">
                </div>
                <div class="carousel-item">
                    <img src="./images/security.jpg" alt="New York" width="1100" height="500">
                </div>
            </div>
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
    <br><br><br><br>
    <!--Footer-->
    <?php
        require_once('tmp/footer.php')
    ?>
</body>
</html>