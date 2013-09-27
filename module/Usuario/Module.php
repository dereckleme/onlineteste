<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuario;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;

use Usuario\Service\Usuario AS serviceUsuario;
use Usuario\Service\Cadastro AS serviceCadastro;
use Usuario\Auth\Adapter AS AuthAdapter;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

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
    					'Usuario\Service\Usuario' => function($service) {
    						$UsuarioService = new serviceUsuario($service->get("Doctrine\ORM\EntityManager"));
    						return $UsuarioService;
    					},
    					'Usuario\Service\Cadastro' => function($service) {
    						$UsuarioService = new serviceCadastro($service->get("Doctrine\ORM\EntityManager"));
    						return $UsuarioService;
    					},
    					'Usuario\Auth\Adapter' => function($sm)
    					{
    						return new AuthAdapter($sm->get('Doctrine\ORM\EntityManager'));
    					}
    			),
    	);
    }
}
