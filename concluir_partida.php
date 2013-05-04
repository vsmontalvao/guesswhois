<?php
    require 'database.php';
    $tempo_jogador = $_POST['tempo'];
    $match_id = $_POST['match_id'];
    $jogador_acertou = $_POST['acertou'];
    $pontuacao = 0;
    if ($jogador_acertou == 1) {
        $pontuacao = 100 - $tempo_jogador;
    } else{
        $pontuacao = 50 - $tempo_jogador;
    }
    $match = getMatch($match_id, $db);
    if ($match["tmp1"] == 0) {
        updateMatch($match_id, "tmp1=".$tempo_jogador.", terminou1=1, punctuation1=".$pontuacao, $db);
        echo "Your punctuation was ".$pontuacao.". Is your opponent going to be better??";
    }else{
        updateMatch($match_id, "tmp2=".$tempo_jogador.", terminou2=1, punctuation2=".$pontuacao, $db);
        $pontuacao1 = $match["punctuation1"];
        $pontuacao2 = $pontuacao;
        if ($pontuacao1 < $pontuacao2){
            updateMatch($match_id, "venceu=2", $db);
            echo "Oh My Gosh, you won with ".$pontuacao2." vs ".$pontuacao1;
        }else{
            updateMatch($match_id, "venceu=1", $db);
            echo "You are terrible, you lost. Feel ashamed...";
        }
    }



?>