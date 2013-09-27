<?php
namespace Pagseguro\Curl;
use Doctrine\ORM\EntityManager;

use Zend\Config\Reader\Xml;
class Retorno
{
    protected $email;
    protected $token;
    public function __construct($email,$token)
    {
        $this->email = $email;
        $this->token = $token;
    }
    public function requisicao($notificationCode)
    {
        $url = "https://ws.pagseguro.uol.com.br/v2/transactions/notifications/{$notificationCode}?email={$this->email}&token={$this->token}";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Acessar a URL e retornar a saída
        $output = curl_exec($ch);
        // liberar
        curl_close($ch);
        $xml = new Xml();
              if($output != "Unauthorized" && !empty($output))
              {
           $data = $xml->fromString($output);
              };
    	return $data;
    }
}