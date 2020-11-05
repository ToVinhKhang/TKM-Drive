<?php
    require_once('config.php');
?>

<?php
    //Download file
    require_once('tmp/temp.php');
    $userfolder = substr($temp, 0, strrpos($temp, '@'));
    if (isset($_GET['download'])) {
        $name = $_GET['download'];
        $filepath = 'drivedata/' . $userfolder . '/'. $name;

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.$name.'"' );
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            ob_clean();
            flush();
            readfile($filepath);
            exit;
        }
    }

    //Upload file
    $target_dir = "drivedata/".$userfolder.'/';
    $target_file = $target_dir . basename($_FILES["MyFile"]["name"]);
    $uploadOk = 1;
    $tailfile = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if (file_exists($target_file)) {
        $uploadOk = 0;
        setShowMessIfFail('Your file already exists');
        redirect('TKMDrive/drive.php?dir=TKMDrive');
        
    }
    else if ($_FILES["MyFile"]["size"] > 250000000) {
        $uploadOk = 0;
        setShowMessIfFail('Your file must be < 250 MB');
        redirect('TKMDrive/drive.php?dir=TKMDrive');
    }
    else if($tailfile == "exe") {
        $uploadOk = 0;
        setShowMessIfFail('We are not support with .exe extension');
        redirect('TKMDrive/drive.php?dir=TKMDrive');
    }

    if ($uploadOk == 0) {
        redirect('TKMDrive/drive.php?dir=TKMDrive');
    } 
    else{
        if (move_uploaded_file($_FILES["MyFile"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["MyFile"]["name"]). " has been uploaded.";
            setShowMess('Upload success.');
            redirect('TKMDrive/drive.php?dir=TKMDrive');
        }
        else{
            setShowMessIfFail('Upload failed.');
            redirect('TKMDrive/drive.php?dir=TKMDrive');
        }
    }
?>


