<?php namespace cgc\traits;

use cgc\enums\Method;

Trait RequestTrait {
  private function create_curl_options(array $data, Method $method){
    $method = strtoupper($method->name);

    $options = array(
      CURLOPT_HTTPHEADER => array(
        "Tbk-Api-Key-Id: {$this->id}",
        "Tbk-Api-Key-Secret: {$this->secret}",
        "Content-type: application/json"
      ),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_POSTFIELDS => json_encode($data)
    );

    return $options;
  }

  private function send_request(string $url, array $data, Method $method){
    $curl = curl_init();

    $options = $this->create_curl_options($data, $method);

    curl_setopt_array($curl, $options);
    curl_setopt($curl, CURLOPT_URL, $url);

    $result = curl_exec($curl);

    if ($result === false) {
      $error = curl_error($curl);
      curl_close($curl);
      return [
        'error' => $error
      ];
    }

    curl_close($curl);
    return json_decode($result, true);
  }


}
