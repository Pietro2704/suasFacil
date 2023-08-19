<?php

function obterHoraAtual() { // Função para obter hora atual

    $apiUrl = "http://worldtimeapi.org/api/ip";
    
    $response = file_get_contents($apiUrl); // função file_get_contents() é usada para fazer uma solicitação GET à URL da API
    
    $data = json_decode($response, true); // função json_decode() é usada para decodificar o JSON contido na variável 'response'
    // O 'true' faz com que o JSON seja decodificado em um array associativo

    
    if (isset($data['datetime'])) { // Se o campo 'datetime' existe no array

        $dateTime = new DateTime($data['datetime']); // Cria um objeto DateTime com base no valor 'datetime' da resposta
        
        $hora = $dateTime->format('H'); // Obtém hora do objeto DateTime
        $minuto = $dateTime->format('i'); // Obtém minuto do objeto DateTime
        $segundo = $dateTime->format('s'); // Obtém segundo do objeto DateTime   
        
        return "Hora atual: $hora : $minuto : $segundo"; // Retorna uma string formatada com a hora, minuto e segundo

    } else { // Senão
        
        return "Não foi possível obter a hora atual."; // Retorna uma mensagem de erro caso 'datetime' não exista na resposta

    }
}
?>
