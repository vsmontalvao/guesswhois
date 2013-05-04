$(document).ready(function () {
    var inicio = new Date();
});

function calcular_diferenca (tempo_inicial) {
    var fim = new Date();
    return ((fim - inicio)/1000).toFixed(1);
}

function post_tempo_usuario (tempo, match_id, acertou) {
    $.post(
        '/concluir_partida.php',
        {
            'tempo': tempo,
            'match_id': match_id,
            'acertou': acertou
        },
        function (resposta) {
            alert('acabou');
        }
    );
}