<?php
function obterHoraAtual() {
    
    // URL da API para obter a hora atual da zona de fuso horário "America/Sao_Paulo"
    $apiUrl = "http://worldtimeapi.org/api/timezone/America/Sao_Paulo";
    
    // Faz uma solicitação à API e obtém a resposta
    $response = file_get_contents($apiUrl);
    
    // Decodifica a resposta JSON em um array associativo
    $data = json_decode($response, true);

    // Verifica se o campo 'datetime' existe no array
    if (isset($data['datetime'])) {
        // Cria um objeto DateTime com base no valor 'datetime' da resposta
        $dateTime = new DateTime($data['datetime']);
        
        // Obtém as partes de hora, minuto e segundo do objeto DateTime
        $hora = $dateTime->format('H');
        $minuto = $dateTime->format('i');
        $segundo = $dateTime->format('s');
        
        // Retorna uma string formatada com a hora, minuto e segundo
        return "Hora atual: $hora : $minuto : $segundo";
    } else {
        // Retorna uma mensagem de erro caso 'datetime' não exista na resposta
        return "Não foi possível obter a hora atual.";
    }
}
?>
