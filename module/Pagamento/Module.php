<?php
namespace Pagamento;

use Pagamento\Service\Estoque as serviceEstoque;
use Pagamento\Service\Recibo as serviceRecibo;
use Pagamento\Service\Pedido as servicePedido;
class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig(){
    	return array(
    	    'factories' => array(
    	        'Pagamento\Service\Estoque' => function($service){
    	    	    $estoque = new serviceEstoque($service->get('Doctrine\ORM\EntityManager'));
    	    	    return $estoque;
    	        },
    	        'Pagamento\Service\Recibo' => function($service){
    	        	$recibo = new serviceRecibo($service->get('Doctrine\ORM\EntityManager'));
    	        	return $recibo;
    	        },
    	        'Pagamento\Service\Pedido' => function($service){
    	        	$pedido = new servicePedido($service->get('Doctrine\ORM\EntityManager'));
    	        	return $pedido;
    	        },
    	    )
    	);
    }
    
}
