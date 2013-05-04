<?php
    require 'database.php';
    $tempo_jogador = $_POST['tempo'];
    $match_id = $_POST['match_id'];
    $jogador_acertou = $_POST['acertou'];
    if (getMatch($match_id, $db)["tmp1"] == 0) {
        updateMatch($match_id, "tmp1=".$tempo_jogador.", terminou1=".1, $db);
        echo "true";
    }else{
        updateMatch($match_id, "tmp2=".$tempo_jogador.", terminou2=".1, $db);
        $tempo1 = getMatch($match_id, $db)["tmp1"];
        $tempo2 = $tempo_jogador;
        if ($tempo1 > $tempo2){
            updateMatch($match_id, "venceu=".2, $db);
            echo "Você venceu!";
        }else{
            updateMatch($match_id, "venceu=".1, $db);
            echo "Você perdeu!";
        }
    }



?>