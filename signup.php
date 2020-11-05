<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign up - TKM Drive Online</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="./js/Signup.js"></script>
    <link rel="stylesheet" href="./css/login.css">
    <link rel='icon' type="image/png" sizes="16x16" href="./images/logoTKM.png">
</head>

<body>
    <!--Header-->
    <?php
        require_once('tmp/header.php')
    ?>

    <!--Sign up-->
    <?php
        require_once('config.php');
        $pwd = filter_input(INPUT_POST, 'pwd',FILTER_SANITIZE_STRING);
        $cfpwd = filter_input(INPUT_POST, 'cfpwd',FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_STRING);

        if($email){
            if(issetAcountFromDatabase($email)==true){
                setShowMessIfFail('This account already exists.');
            }
            else if($pwd && $email && $cfpwd){
                $S_SESSION['signupemail']=$email;
                $S_SESSION['signuppwd']=$pwd;
                $S_SESSION['signupcfpwd']=md5($pwd);
                $db = getDB();
                $result = getDrive($db);
                $result = AddNewAccount($S_SESSION['signupemail'],$S_SESSION['signuppwd'],$S_SESSION['signupcfpwd']);
                setShowMess('Sign up success.');
            }
        }
    ?>
    
    <br><br><br><br>
    <div class="container">
        
        <form action="" onsubmit="return CheckInputSignUp()" method="POST">
            <h2>Sign up</h2>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" onclick="ClearErrorMess()" class="form-control" id="email" placeholder="Enter your email" name="email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" onclick="ClearErrorMess()" class="form-control" id="pwd" placeholder="Enter your password" name="pwd">
            </div>
            <div class="form-group">
                <label for="cfpwd">Confirm password:</label>
                <input type="password" onclick="ClearErrorMess()" class="form-control" id="cfpwd" placeholder="Enter your confirm password" name="cfpwd">
            </div>

            <p id="ErrorMess"></p>
            <button type="submit" class="btn btn-dark" style='width: 100px;'>Sign up</button>
            <button type="reset" class="btn">Reset</button>
        </form>
        <form action='login.php'>
            <button style='float: left' type="submit" class="btn btn-dark">Back</button>
        </form>
    </div>
    <br><br><br>
    <!-- ShowMess -->
    <?php
        require_once('tmp/showmess.php')
    ?>           
</body>
</html>
