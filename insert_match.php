<?php
    include 'database.php';
    
    $user_id = $_POST['user_id'];
    $friend_id = $_POST['friend_id'];
    $f1 = $_POST['f1'];
    $f2 = $_POST['f2'];
    $f3 = $_POST['f3'];
    $f4 = $_POST['f4'];
    
//     die('uid'.$user_id.' fid'.$friend_id.' f1'.$f1.' f2'.$f2.' f3'.$f3.' f4'.$f4);                       
    
    createMatch("8", "1", "3", "4", "5", "6", $db);
    
    $match_obj = createMatch($user_id, $friend_id, $f1, $f2, $f3, $f4, $db);
    die($match_obj);
    $match_id = $match_obj["lastval"];
    echo "/playmatch.php?match_id=".$match_id;
?>