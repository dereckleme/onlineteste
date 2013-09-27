<?php
namespace Pagseguro;
use Pagseguro\Curl\post AS postCurl; 
use Pagseguro\Curl\Retorno;
use Pagseguro\Service\Pagseguro;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

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
    					'Pagseguro\Curl\post' => function($service) {
    					    $config = $service->get("config");
    					        if($config['pagSeguroDereck']['autenticado'] == 1)
    					        {
    					            $auth = new AuthenticationService;
    					            $auth->setStorage(new SessionStorage($config['pagSeguroDereck']['SessionStorage']));
    					            if($auth->hasIdentity())
    					            {
    						            $Service = new postCurl($config['pagSeguroDereck']['email'],$config['pagSeguroDereck']['token'], $config['pagSeguroDereck']['currency'],$service);
    					            }
    					            else
    					            {
    					                $Service = new postCurl(); // fechado
    					            }
    					        }
    					        else
    					        {
    					    $Service = new postCurl(); // fechado
    					        }
    						return $Service;
    					},
    					'Pagseguro\Service\Pagseguro' => function($service) {
    					    $pagseguro = new Pagseguro($service->get('Doctrine\ORM\EntityManager'));
    					    return $pagseguro;
    					},
    					'Pagseguro\Curl\Retorno' => function($service) {
    					    $config = $service->get("config");
    					    $Service = new Retorno($config['pagSeguroDereck']['email'],$config['pagSeguroDereck']['token']);
    					    return $Service;
    					},
    					
    			),
    	);
    }
}
