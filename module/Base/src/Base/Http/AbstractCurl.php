<?php
namespace Base\Http;

use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Http\Client\Adapter\Curl; // Biblioteca zend curl


abstract class AbstractCurl 
{    
    protected $itens;
    protected $uri;
    protected $action;
    protected $content;
    
    
	public function __construct(){
    	$this->itens = array();
    }
    
    public function requisicao(array $items){
    	
        foreach($items as $key => $value)
        {
        	$this->itens[] = "$key=$value";
        }        
        $this->content = implode("&", $this->itens);
        
        
        $request = new Request;        
        $request->getHeaders()->addHeaders(['Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8']);
        $request->setUri($this->uri);
        $request->setMethod($this->action); //uncomment this if the POST is used
        $request->setContent($this->content);
        
        $client = new Client;
        $adapter = new Curl();
        $adapter->setOptions(array(
        		'curloptions' => array(
        				CURLOPT_POST => 1,
        				CURLOPT_SSL_VERIFYPEER => FALSE,
        				CURLOPT_SSL_VERIFYHOST => FALSE,
        		)
        ));
        $client->setAdapter($adapter);
        $retorno = $client->dispatch($request)->getContent();
                
        if($retorno != "Unauthorized" && !empty($retorno))
        {                        
            return $retorno;            
        }
        else
        {
        	return array("resposta"=>false);
        }
        
    }
    
}