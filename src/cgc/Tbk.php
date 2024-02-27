<?php namespace cgc;

use cgc\traits\RequestTrait;
use cgc\enums\Method;

class Tbk {
  use RequestTrait;

  private $id;
  private $secret;
  private $endpoint;

  public function __construct() {
    $this->id = getenv('TBK_API_KEY_ID');
    $this->secret = getenv('TBK_API_KEY_SECRET');
    $env = getenv('TBK_ENV');

    if($env==='production'){
      $this->endpoint = 'https://webpay3g.transbank.cl';
    }else{
      $this->endpoint = 'https://webpay3gint.transbank.cl';
    }

    if($this->id == null || $this->secret == null) {
      throw new \Exception('TBK_API_KEY_ID or TBK_API_KEY_SECRET not found in .env, please check your configuration');
    }
  }

  /**
   * Create a transaction
   * @param double $amount Transaction amount. Maximum 2 decimal places for USD. Maximum length: 17
   * @param string $buy_order Store purchase order. This number must be unique for each transaction. Maximum length: 26. The purchase order can have: Numbers, letters, upper and lower case letters, and the signs |_=&%.,~:/?[+!@()>-
   * @param string $session_id Session identifier, internal business use, this value is returned at the end of the transaction. Maximum length: 61
   * @param string $return_url Merchant URL, to which Webpay will redirect after the authorization process. Maximum length: 256
   * @return array|null
   */
  public function create_transaction(float $amount, string $buy_order, string $session_id, string $return_url){
    if(strlen($buy_order)>26){
      throw new \Exception('Invalid buy_order, it must be at most 26 characters.' );
    }
    if($amount===0 || strlen((string)$amount)>17){
      throw new \Exception('Invalid amount, it must be a number with at most 17 digits and greater than 0.' );
    }
    if(strlen($session_id)>61){
      throw new \Exception('Invalid session_id, it must be at most 61 characters.' );
    }
    if(strlen($return_url)>256){
      throw new \Exception('Invalid return_url, it must be at most 256 characters.' );
    }
    $data = [
      'amount'=>$amount,
      'buy_order'=>$buy_order,
      'session_id'=>$session_id,
      'return_url'=>$return_url
    ];
    $url=$this->endpoint . '/rswebpaytransaction/api/webpay/v1.2/transactions';
    $result = $this->send_request($url, $data, Method::POST);

    return $result;
  }

  /**
   * Confirm a transaction
   * @param string $token Transaction token. Length: 64. (Sent in the URL, not in the body)
   * @return array|null
   */
  public function confirm_transaction(string $token): array|null{
    if(strlen($token)<64){
      throw new \Exception('Invalid token, it must be 64 characters long');
    }

    $url = $this->endpoint . '/rswebpaytransaction/api/webpay/v1.2/transactions/' . $token;
    $result = $this->send_request($url, [], Method::PUT);

    return $result;
  }
}
