<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Produto;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Produto\Service\Produto AS serviceProduto;
use Produto\Service\Categoria AS serviceCategoria;
use Produto\Service\Subcategoria AS serviceSubcategoria;
use Produto\Service\Referencia AS serviceReferencia;
use Produto\Service\ProdutoImagens AS serviceImagens;

class Module {
    
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
    			'Produto\Service\Produto' => function($service){
    				$produto = new serviceProduto($service->get('Doctrine\ORM\EntityManager'));
    				return $produto;
    			},    			
    			'Produto\Repository\Categorias' => function($service){
    			    $em = $service->get('Doctrine\ORM\EntityManager');
    			    $repository = $em->getRepository("Produto\Entity\ProdutoCategorias");
    			    return $repository;
    			},
    			'Produto\Repository\SubCategorias' => function($service){
    				$em = $service->get('Doctrine\ORM\EntityManager');
    				$repository = $em->getRepository("Produto\Entity\ProdutoSubcategoria");
    				return $repository;
    			},    			
    			'Produto\Repository\Produtos' => function($service){
    				$em = $service->get("Doctrine\ORM\EntityManager");
    				$repositor = $em->getRepository("Produto\Entity\ProdutoProdutos");
    				return $repositor;
    			},    			
    			'Produto\Service\Categoria' => function($service){
    				$categoria = new serviceCategoria($service->get('Doctrine\ORM\EntityManager'));
    				return $categoria;
    			},
    			'Produto\Service\Referencia' => function($service){
    				$categoria = new serviceReferencia($service->get('Doctrine\ORM\EntityManager'));
    				return $categoria;
    			},
    			'Produto\Service\Subcategoria' => function($service){
    				$subcategoria = new serviceSubcategoria($service->get('Doctrine\ORM\EntityManager'));
    				return $subcategoria;
    			},
    			'GenericService\Repository' => function($service){
    				return $service;
    			},
    			/*'Produto\Service\Imagens' => function($service){
    				$imagens = new serviceImagens($service->get('Doctrine\ORM\EntityManager'));
    				return $imagens;
    			}*/
    		)
    	);
    }
    
}