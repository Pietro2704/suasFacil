<?php
  function obterHoraAtual() {
    $apiUrl = "http://worldtimeapi.org/api/timezone/America/Sao_Paulo";
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);

    if (isset($data['datetime'])) {
      $dateTime = new DateTime($data['datetime']);
      $hora = $dateTime->format('H');
      $minuto = $dateTime->format('i');
      $segundo = $dateTime->format('s');
      return "Hora atual: $hora : $minuto : $segundo";
    } else {
      return "Não foi possível obter a hora atual.";
    }
  }
?>