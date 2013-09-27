<?php
namespace CarrinhoCompras;
use CarrinhoCompras\Service\Carrinho AS carrinhoService;
use CarrinhoCompras\Model\Carrinho AS carrinhoModel;
use Zend\Session\Container;
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
    public function getServiceConfig() {
    
    	return array(
    			'factories' => array(
    					'CarrinhoCompras\Service\Carrinho' => function($service) {
    					   $carrinho = new carrinhoService(new Container('Site'));
    					   return $carrinho;
       					},
       					'CarrinhoCompras\Model\Carrinho' => function($service) {
       					    
       					     $repository = $service->get("Produto\Repository\Produtos");
       						$carrinho = new carrinhoModel(new Container('Site'),$repository);
       						return $carrinho;
       					}
    			),
    	);
    }
}
