<?php
    include 'database.php';

    $user_id = $_POST['user_id'];
    $friend_id = $_POST['friend_id'];
    $f1 = $_POST['f1'];
    $f2 = $_POST['f2'];
    $f3 = $_POST['f3'];
    $f4 = $_POST['f4'];
    
    $match_id = createMatch($user_id, $friend_id, $f1, $f2, $f3, $f4, $db);
    echo "/playmatch.php?match_id=".$match_id;

?>