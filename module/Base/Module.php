<?php
namespace Base;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;
use Zend\Mvc\MvcEvent;
use Base\Service\Caminho;
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
    					'Base\Service\Caminho' => function($service){
    						$caminho = new Caminho($service);
    						return $caminho;
    					},
    			));
    }					
    public function onBootstrap($e)
    {
    	$e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
    	    
    		/*
    		 * Definições de sessoes
    		*/
    		$auth = new AuthenticationService;
    		$auth->setStorage(new SessionStorage("Usuario"));
    		$controller      = $e->getTarget();
    		$controllerClass = get_class($controller);
    		$moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
    		$config          = $e->getApplication()->getServiceManager()->get('config');
    		
    		/*
    		 * Permissão de usuário
    		*/
    		$matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();
    		
    		/*
    		 * Definição de Layout de todos modulos
    		*/
    		if($auth->hasIdentity())
    		{
    			 
    			if($auth->getIdentity()->getNivelUsuario() != 1)
    			{
    
    				if (isset($config['module_layouts'][$moduleNamespace])) {
    					$controller->layout($config['module_layouts'][$moduleNamespace]."_logado");
    					$controller->layout()->infoUser = $auth->getIdentity();
    				}
    			}
    			else
    			{
    				if (isset($config['module_layouts'][$moduleNamespace])) {
    					$controller->layout($config['module_layouts'][$moduleNamespace]."_logado_adm");
    					$controller->layout()->infoUser = $auth->getIdentity();
    				}
    			}
    		}
    		else
    		{
    
    			if (isset($config['module_layouts'][$moduleNamespace])) {
    				$controller->layout($config['module_layouts'][$moduleNamespace]);
    			}
    		}
    		
    		/*
    		 * Definições para bloqueio total de usuários no admin
    		*/
    		$adminRoute = explode("-",$matchedRoute);
    		if(!$auth->hasIdentity() and ($adminRoute[0] == "admin" || $adminRoute[0] == "Painel"))
    		{
    			return $controller->redirect()->toRoute("home");
    		}
    		else if($auth->hasIdentity())
    		{
    		    
    			 
    			if($auth->getIdentity()->getNivelUsuario() != 1)
    			{
    				if($adminRoute[0] == "admin")
    				{
    					return $controller->redirect()->toRoute("home");
    				}
    			}
    		}
    		/*
    		 * Carrinho de compras Session
    		 */
    		
    		$eventoCarrinho = $e->getApplication()->getServiceManager()->get('CarrinhoCompras\Model\Carrinho');
    		$controller->layout()->carrinhoLista = array(
    				"listaAtual" =>  $eventoCarrinho->lista(),
    				"valorTotal" => $eventoCarrinho->calculoTotal()
    		);
    		
    		/*
    		 * Listagem de categorias
    		 */    		    	
    		$eventoCategoria = $e->getApplication()->getServiceManager()->get('Produto\Repository\Produtos');
    		$categorias = $eventoCategoria->myFindAll();
    		$controller->layout()->categorias = $categorias;
    		
    		
    		/*
    		 * $matchedRoute
    		 */
    		$controller->layout()->matchedRoute = $matchedRoute;
    		
    		/*
    		 * Caminho site
    		 */
    		
    		$serviceCaminho = $e->getApplication()->getServiceManager()->get('Base\Service\Caminho');
    		$serviceCaminho->setMatchedRoute($matchedRoute);
    		$serviceCaminho->setController($controller);
    		$controller->layout()->caminhoDefines = $serviceCaminho->geraCaminho();
    		
    		
    	}, 100);
      
    }
}
