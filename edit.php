<?php
    require_once('config.php');
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    $renamefile = filter_input(INPUT_GET, 'renamefile', FILTER_SANITIZE_STRING);

    $useremail=$_SESSION['email'];
    $userfolder = substr($useremail, 0, strrpos($useremail, '@'));
    $filepath = 'drivedata/' . $userfolder. '/'. $renamefile;

    /*getlink*/
    $fileWannaGetLink = $renamefile;
    $formatFILE = str_replace(" ","%20",$fileWannaGetLink);
    $path2shortURL = 'drivedata/' . $userfolder. '/'. $formatFILE;
    $getshortURL = GetShortURL('http://localhost:8888/TKMDrive/' . $path2shortURL);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Rename - Share Link</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container" style='width: 450px;'>
            <br><br>
            <h1>Rename</h1>
            <form action='' method='POST'>
                <div class="form-group">
                    <p><b>File name:</b></p>
                    <div>
                        <input type="text" class="form-control" value='<?= $renamefile ?>' readonly="readonly">
                    </div>
                </div>
                <div class="form-group">
                    <p><b>New file name:</b></p>
                    <div>
                        <input type="text" class="form-control" name="newname" placeholder="Enter new file name">
                    </div>
                </div>
                <div class="form-group">
                    <div style='float: right;'>
                        <button type="submit" class="btn btn-danger">Rename</button>
                    </div>
                </div>
            </form>


            <br><br><br>
            <hr style='border: 10px solid black; border-radius: 5px;'>
            <br>
            <h1>Share Link</h1>
            <div class="form-group">
                <p><b>Link:</b></p>
                <div>
                    <input type="text" class="form-control" value="<?= $getshortURL ?>" id="Link" readonly="readonly">
                    <br>
                    <div style='float: right;'>
                        <button style='width: 85px; color: black; ' class="btn btn-info" onclick="myFunction()">Copy</button>
                    </div>
                    <form action='drive.php'>
                        <button style='float: left' type="submit" class="btn btn-dark">Back</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function myFunction() {
                var Link = document.getElementById("Link");
                Link.select();
                Link.setSelectionRange(0, 50);
                document.execCommand("copy");
                alert("The link: " + Link.value + " has been copied" );
            }
        </script>
    </body>
</html>

<?php
    /*rename*/
    if($action == 'edit' && file_exists($filepath)){ 
        $newname = filter_input(INPUT_POST, 'newname', FILTER_SANITIZE_STRING);
        $filepathnew = 'drivedata/'. $userfolder . '/' . $newname;
        if($newname){
            $renamed= rename($filepath, $filepathnew);
            if ($renamed){
                setShowMess('Rename success');
                redirect('TKMDrive/drive.php?dir=TKMDrive');
            }
            else{
                setShowMessIfFail('Rename failed');
                redirect('TKMDrive/drive.php?dir=TKMDrive');
            }
        }
    }
?>

    