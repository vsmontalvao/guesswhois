<?php
    include 'database.php';
    
    $user_id = $_POST['user_id'];
    $friend_id = $_POST['friend_id'];
    $f1 = $_POST['f1'];
    $f2 = $_POST['f2'];
    $f3 = $_POST['f3'];
    $f4 = $_POST['f4'];
    $f1name = $_POST['f1name'];
    $f2name = $_POST['f2name'];
    $f3name = $_POST['f3name'];
    $f4name = $_POST['f4name'];
    
    insertUser($f1, "'".$f1name."'", $db);
    insertUser($f2, "'".$f2name."'", $db);
    insertUser($f3, "'".$f3name."'", $db);
    insertUser($f4, "'".$f4name."'", $db);
    
    insertUser($user_id, "'".$user_name."'", $db);
    insertUser($friend_id, "'".$friend_name."'", $db);
    insertUser($user_id, "'".$user_name."'", $db);
    insertUser($friend_id, "'".$friend_name."'", $db);
    
//      die('uid'.$user_id.' fid'.$friend_id.' f1'.$f1.' f2'.$f2.' f3'.$f3.' f4'.$f4);                       
    
//     createMatch("8", "1", "3", "4", "5", "6", $db);
//      createMatch("100001209991711", "576886153", "100002194997699", "100002740989857", "100000130600907", "786883893", $db);
    
    $match_obj = createMatch(strval($user_id), strval($friend_id), strval($f1), strval($f2), strval($f3), strval($f4), $db);
//     die($match_obj["lastval"]);
    $match_id = $match_obj["lastval"];
    echo "/playmatch.php?match_id=".$match_id;
?>