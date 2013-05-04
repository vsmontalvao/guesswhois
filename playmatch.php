<?php

    include 'database.php';
    $match_id = $_GET['match_id'];
    $match = getMatch($match_id, $db)["p2_id"]
    $player = $match->p1_id
    if($match->terminou1){
        $player = p2_id;
    }
    //dar um getMatch e verificar se eh a vez do primeiro ou do segundo player
    //setar alguma flag que diz de quem eh a vez
    //teremos uma variavel chamada $match

?>

//codar o front-end colocando a variavel $match onde for necessaria.