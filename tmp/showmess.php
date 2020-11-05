<?php
    $mess = getShowMess();
    if($mess){
        ?>
        <div id='error' class="alert alert-success" style="width: 600px; text-align: center; margin: auto;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <span id=errorContent><?= $mess ?></span>
        </div>
        <br><br>
        <?php
    }
?>

<?php
    $mess = getShowMessIfFail();
    if($mess){
        ?>
        <div id='error' class="alert alert-danger" style="width: 600px; text-align: center; margin: auto;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <span id=errorContent><?= $mess ?></span>
        </div>
        <br><br>
        <?php
    }
?>