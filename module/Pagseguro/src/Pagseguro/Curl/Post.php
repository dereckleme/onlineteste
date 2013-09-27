<?php
namespace Pagseguro\Curl;
use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Http\Client\Adapter\Curl; // Biblioteca zend curl
use Doctrine\ORM\EntityManager;

use Zend\Config\Reader\Xml;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;
class Post
{
   protected $dados; 
   protected $service;
    public function __construct($email,$token,$currency,$service)
    {
        $this->service = $service;
        $this->dados[] = 'email='.$email;
        $this->dados[] = 'token='.$token;
        $this->dados[] = 'currency='.$currency;
    }
    public function requisicao($reference)
    {
        $xml = new Xml();
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage("Usuario"));
        if($auth->hasIdentity())
        {
            $serviceCarrinho = $this->service->get("CarrinhoCompras\Model\Carrinho");
            $em = $this->service->get("Doctrine\ORM\EntityManager");
            $serviceFrete = $this->service->get("DrkCorreios\Service\Frete");
            $entity = $em->getRepository("Usuario\Entity\UsuarioCadastro")->findOneByusuariosusuarios($auth->getIdentity()->getIdusuario());
            $listItens = $serviceCarrinho->lista();
            $z = 1;
            foreach($listItens AS $produto)
            {
                
                $this->dados[] ="itemId$z=".$produto['produto']->getIdproduto();
                $this->dados[] ="itemDescription$z=".$produto['produto']->getTitulo();
                $this->dados[] ="itemAmount$z=".$produto['produto']->getValor();
                $this->dados[] ="itemQuantity$z=".$produto['quantidade'];
                $z++;
            }
                $comprimento = 0;
                $altura = 0;
                $largura = 0;
                $peso = 0;
            foreach($listItens AS $produto)
            {
            	for($i=1;$i<=$produto['quantidade']; $i++)
            	{
            	$comprimento = $comprimento+$produto['produto']->getComprimento();
            	$altura = $altura+$produto['produto']->getAltura();
            	$largura = $largura+$produto['produto']->getLargura();
            	$peso = $peso+$produto['produto']->getPeso();
            	}
        	}
                $total = ($comprimento+$altura+$largura)/3;
                $comprimento = ceil($total);
                $altura = ceil($total);
                $largura = ceil($total);
                $peso = ceil($peso);
                //minimo Frete
                if($comprimento < 16) $comprimento = 16;
                if($largura < 11) $largura = 11;
                if($altura < 2) $altura = 2;
                //fim
                $serviceFrete->setSCepDestino($entity->getCep());
                $serviceFrete->setNVlComprimento($comprimento);
                $serviceFrete->setNVlAltura($altura);
                $serviceFrete->setNVlLargura($largura);
                $serviceFrete->setNVlPeso($peso);
                $correioOb = $serviceFrete->calcular();
                $arrayXml = $xml->fromString($correioOb);
                $valorFrete = str_replace(",", ".", $arrayXml['cServico']['Valor']);
                //*frete
                
                $this->dados[] ="itemId$z=00";
                $this->dados[] ="itemDescription$z=Valor do Frete";
                $this->dados[] ="itemAmount$z=".$valorFrete;
                $this->dados[] ="itemQuantity$z=1";
                $this->dados[] ="reference=$reference";
                
        $dados = implode("&", $this->dados);
        
        $request = new Request;
        $postString = "username=dereck&password=leme";
        $request->getHeaders()->addHeaders([
        		'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'
        		]);
        $request->setUri('https://ws.pagseguro.uol.com.br/v2/checkout');
        $request->setMethod('POST'); //uncomment this if the POST is used
        $request->setContent($dados);
        
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
        
        $xml = new Xml();
              if($retorno != "Unauthorized" && !empty($retorno))
              {
           $data = $xml->fromString($retorno);
              }
        return $data['code'];
        }
        else 
        {
            return false;
        }
    }
}

?>