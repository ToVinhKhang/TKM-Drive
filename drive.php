<?php
    require_once('config.php');
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <title>Drive - TKM Drive Online</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel ="stylesheet" href="./css/homedrive.css"/>
    <link rel='icon' type="image/png" sizes="16x16" href="./images/logoTKM.png">
    <script src="./js/JavaS.js"></script>
    <style>
        progress[value] {
            -webkit-appearance: none;
            appearance: none;
            width: 200px;
            height: 12px;
        }
        progress[value]::-webkit-progress-value {
            background-image:
                -webkit-linear-gradient(-45deg,transparent 33%, rgba(0, 0, 0, .1) 33%, rgba(0,0, 0, .1) 66%, transparent 66%),
                -webkit-linear-gradient(top, rgba(255, 255, 255, .25), rgba(0, 0, 0, .25)),
                -webkit-linear-gradient(left, #09c, #f44);
            border-radius: 2px; 
            background-size: 35px 20px, 100% 100%, 100% 100%;
        }
    </style>
</head>

<body>
    <script>
        $(document).ready(function () {
            $(".delete").click(function () {
                let name = $(this).data('name');
                let icon = $(this).data('icon');

                $("#nameheader").html(name);
                $("#namequestion").html(name);
                $("#deleteitem").val(name);

                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
        });
        
    </script>
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
                <a class="nav-link" href="drive.php">Services</a>
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

    <?php
        $root = $_SERVER['DOCUMENT_ROOT'];
        $dirname = 'TKMDrive';
        $actionclick = filter_input(INPUT_POST, 'confirm',FILTER_SANITIZE_STRING);
        
        if($dirname){
            $dirpath = $root.'/'.$dirname;
        }
        else{
            $dirpath = $root;
        }
        $drivelink=$dirpath.'/drivedata';                       //Choose drivedata folder is where to get file uploaded.
        $userfolder = substr($nick, 0, strrpos($nick, '@'));    //Format to get username from @email
        $driveLinkOfUser = $drivelink.'/'.$userfolder;          //Folder of each user
        $checkfolder= is_dir($driveLinkOfUser);

        if(!$checkfolder){
            mkdir($driveLinkOfUser);
        }
        $files = scandir($driveLinkOfUser);
    ?>

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
                <?php
                    $Limit = 3000;
                    $memoriestemp = round((folderSize($driveLinkOfUser)/1000000)/$Limit*100.0,1);
                    $memory2BoNho = round(folderSize($driveLinkOfUser)/1000000.0,1);
                    
                    if($memoriestemp >= 95){
                        $PercentMemories = 99.99;
                        setShowMessIfFail('Memory capacity exceeds the allowed limit');
                    }
                    else{
                        $PercentMemories = $memoriestemp;
                    }
                    $_SESSION['memory'] = $memory2BoNho;
                ?>
                <nav class="navbar navbar-light ">
                    <ul id="ulmenu" class="navbar-nav nav nav-pills">
                        <li id="menu" class="nav-item"><a class="nav-link" href=""><b>TKMDrive của tôi</b></a></li>
                        <div class="dropdown-divider"></div>
                        <li id="menu" class="nav-item"><a class="nav-link" href="share.php">Được chia sẻ với tôi</a></li>
                        <div class="dropdown-divider"></div>
                        <li id="menu" class="nav-item"><a class="nav-link" href="notestar.php">Gắn dấu sao</a></li>
                        <div class="dropdown-divider"></div>
                        <li id="menu" class="nav-item"><a class="nav-link" href="trash.php">Thùng rác</a></li>
                        <div class="dropdown-divider"></div>
                        <li id="menu" class="nav-item"><a class="nav-link" href="memories.php">Bộ nhớ</a></li>
                        <br>
                        <!-- Task Memories -->
                        <progress max="100" value="<?= $memoriestemp ?>"></progress>
                        <b><?= $PercentMemories.' %' ?></b>
                        <br><br>
                    </ul>
                </nav>
            </div>


            <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
                <h4><img src="./images/folder.png" width="40" height="40" alt="folder icon">&thinsp;Thư mục của tôi</h4>
                
                <table id="MyTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Tên file</th>
                            <th>Chủ sở hữu</th>
                            <th>Loại</th>
                            <th>Cập nhật lần cuối</th>
                            <th>Kích cỡ tệp</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>

                    <tbody id="table-body">
                        <?php
                            foreach ($files as $file) {
                                if(substr($file, 0,1)==='.'){
                                    continue;
                                }

                                $link = $driveLinkOfUser.'/'.$file;             //Path 
                                $isDir = is_dir($link);                         //Check Directory
                                $tail = strtolower(pathinfo($link,PATHINFO_EXTENSION));     //Tail .html .php ...
                                if(file_exists($link)){
                                    $time = date('d/m/Y',filemtime($link));     //Or ('M d Y') still OK
                                }
                                $size = "-";                                    //Size file

                                $dirLink = str_replace($root, '', $link);
                                $dirLink = substr($dirLink, 1);

                                if($isDir){
                                    $dirLink = "?dir=$dirLink";
                                }
                                else{
                                    $dirLink = 'http://localhost:8888/'.$dirLink;
                                }
                                
                                

                                if(!$isDir){
                                    if(file_exists($link)){
                                        $size = filesize($link);
                                        $size2count=filesize($link);
                                    }
                                    if($size > 1000000){
                                        $size = round($size/1000000.0,1).' MB';
                                    }
                                    else if($size > 1000){
                                        $size = round($size/1000.0,1).' KB';
                                    }
                                    else{
                                        $size = $size.' Bytes';
                                    }
                                }

                                if($isDir){
                                    $type = "Directory";
                                    $icon = "./images/foldericon.png";
                                }
                                else if($tail == 'html'){
                                    $type = "HTML File";
                                    $icon = "./images/htmlicon.png";
                                }
                                else if($tail == 'php'){
                                    $type = "PHP File";
                                    $icon = "./images/phpicon.png";
                                }
                                else if($tail == 'png'){
                                    $type = "PNG Image";
                                    $icon = "./images/pngicon.png";
                                }
                                else if($tail == 'jpg'){
                                    $type = "JPG Image";
                                    $icon = "./images/jpgicon.png";
                                }
                                else if($tail == 'mp3'){
                                    $type = "MP3 Music";
                                    $icon = "./images/mp3icon.png";
                                }
                                else if($tail == 'mp4'){
                                    $type = "MP4 Music";
                                    $icon = "./images/mp4icon.png";
                                }
                                else if($tail == 'doc'){
                                    $type = "DOC Document";
                                    $icon = "./images/docicon.png";
                                }
                                else if($tail == 'docx'){
                                    $type = "DOCX Document";
                                    $icon = "./images/docxicon.png";
                                }
                                else if($tail == 'pdf'){
                                    $type = "PDF Document";
                                    $icon = "./images/pdficon.png";
                                }
                                else if($tail == 'xls'){
                                    $type = "XLS Document";
                                    $icon = "./images/xlsicon.png";
                                }
                                else if($tail == 'xlsx'){
                                    $type = "XLSX Document";
                                    $icon = "./images/xlsxicon.png";
                                }
                                else if($tail == 'ppt'){
                                    $type = "PPT Document";
                                    $icon = "./images/ppticon.png";
                                }
                                else if($tail == 'pptx'){
                                    $type = "PPTX Document";
                                    $icon = "./images/pptxicon.png";
                                }
                                else if($tail == 'py'){
                                    $type = "PYTHON File";
                                    $icon = "./images/pythonicon.png";
                                }
                                else if($tail == 'java'){
                                    $type = "JAVA File";
                                    $icon = "./images/javaicon.png";
                                }
                                else if($tail == 'c'){
                                    $type = "C File";
                                    $icon = "./images/cicon.png";
                                }
                                else if($tail == 'cpp'){
                                    $type = "C++ File";
                                    $icon = "./images/cppicon.png";
                                }
                                else if($tail == 'cs'){
                                    $type = "C# File";
                                    $icon = "./images/csharpicon.png";
                                }
                                else if($tail == 'js'){
                                    $type = "JAVASCRIPT File";
                                    $icon = "./images/jsicon.png";
                                }
                                else if($tail == 'css'){
                                    $type = "CSS File";
                                    $icon = "./images/cssicon.png";
                                }
                                else if($tail == 'mov'){
                                    $type = "MOV Video";
                                    $icon = "./images/movicon.png";
                                }
                                else if($tail == 'iso'){
                                    $type = "ISO Archive";
                                    $icon = "./images/isoicon.png";
                                }
                                else if($tail == 'rar'){
                                    $type = "RAR Archive";
                                    $icon = "./images/raricon.png";
                                }
                                else if($tail == 'zip'){
                                    $type = "ZIP Archive";
                                    $icon = "./images/zipicon.png";
                                }
                                else if($tail == 'sql'){
                                    $type = "SQL Database";
                                    $icon = "./images/sqlicon.png";
                                }
                                else if($tail == 'txt'){
                                    $type = "TEXT Document";
                                    $icon = "./images/txticon.png";
                                }
                                else if($tail == 'm'){
                                    $type = "MATLAB File";
                                    $icon = "./images/matlabicon.png";
                                }
                                else{
                                    $type = "UNKNOWN File";
                                    $icon = "./images/unknownicon.png";
                                }
                                
                                /*Delete*/
                                if($actionclick){ 
                                    delete_files($driveLinkOfUser.'/'.$_POST['confirm']);
                                    setShowMess('Delete success.');
                                }
                                
                                ?>
                                    <tr>
                                        <td><img src="<?= $icon ?>" style="width: 40px;height:40px;"></td>
                                        <td><a href="upload.php?download=<?= $file ?>"><?= $file ?></a></td>
                                        <td><?= $nick ?></td>
                                        <td><?= $type ?></td>
                                        <td><?= $time ?></td>
                                        <td><?= $size ?></td>
                                        <td>
                                            <form action='edit.php?' method="GET" style='display: inline;'>
                                                <input type="hidden" name="action" value='edit'>
                                                <input type="hidden" name="renamefile" value='<?= $file ?>'>
                                                <button class='btn btn-info' type='submit'>Khác</button>
                                            </form>
                                            <button style='width: 60px; ' data-icon='<?= $icon ?>' data-name='<?= $file ?>' class='btn btn-danger delete' type='button'>Xóa</button>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                        
                    </tbody>
                </table>

                <!-- ShowMess -->
                <?php
                    require_once('tmp/showmess.php')
                ?>
            </div>
        </div>
    </div>
    <br><br><br><br>
    <!--Footer-->
    <?php
        require_once('tmp/footer.php')
    ?>

    <!-- Delete Confirm Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id='nameheader' class="modal-title">Modal Header</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa <b><span id='namequestion'></span></b>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>

                    <form action='' method='POST' style='display: inline;'>
                        <input id='deleteitem' type='hidden' name='confirm' value='??'>
                        <button type="submit" class="btn btn-danger">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!-- Refesh page After Click Delete -->
<?php
    if($actionclick){
        ?>
            <meta http-equiv="refresh" content="0">
        <?php
    }
?>