<?php
namespace DrkCorreios\Service;

use Base\Http\AbstractCurl;
use Zend\Dom\Query;

class DrkCorreios extends AbstractCurl
{
    public function __construct(){
        parent::__construct();
        $this->uri = "http://www.buscacep.correios.com.br/servicos/dnec/consultaLogradouroAction.do";
        $this->action = 'POST';        
    }
    
    public function requisicaoDom($array)
    {
    	$request = $this->requisicao($array);
    	
    	$dom = new Query($request);
    	$results = $dom->execute('.content .ctrlcontent div table[1] tr[1]');
    	
    	$count = count($results);
    	
    	$contents = array();
    	foreach($results as $result)
    	{
    		if($result->hasAttributes())
    		{
    			$tdelement = $result->getElementsByTagName("td");
    			/*$contents = array(
    					'rua' => utf8_encode($tdelement->item(0)->nodeValue),
    					'bairro' => utf8_encode($tdelement->item(1)->nodeValue),
    					'uf' => utf8_encode($tdelement->item(2)->nodeValue),
    					'cid' => utf8_encode($tdelement->item(3)->nodeValue),
    					'cep' => utf8_encode($tdelement->item(4)->nodeValue)
    			);*/
    			$contents = array(
    					'rua' => $tdelement->item(0)->nodeValue,
    					'bairro' => $tdelement->item(1)->nodeValue,
    					'cid' => $tdelement->item(2)->nodeValue,
    					'uf' => $tdelement->item(3)->nodeValue,
    					'cep' => $tdelement->item(4)->nodeValue
    			);
    	
    		}
    	
    	}
    	    	
    	return $contents;
    	
    }
    
} 