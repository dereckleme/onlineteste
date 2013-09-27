<?php
return array(
    'router' => array(
    		'routes' => array(
    		    /*
    		     * Inicio das Rotas Publicas
    		    */
    		    'publico-categoria' => array(
    		    		'type'    => 'Literal',
    		    		'options' => array(
    		    				'route'    => '/selecione',
    		    				'defaults' => array(
    		    						'__NAMESPACE__' => 'ProdutoPublic\Controller',
    		    						'controller'    => 'Index',
    		    						'action'        => 'index',
    		    				),
    		    		),
    		    ),
    
    		),
    ),
    'controllers' => array(
    		'invokables' => array(
    				'ProdutoPublic\Controller\Index' => 'ProdutoPublic\Controller\IndexController'
    		),
    ),
    'view_manager' => array(
    		'display_not_found_reason' => true,
    		'display_exceptions'       => true,
    		'doctype'                  => 'HTML5',
    		'not_found_template'       => 'error/404',
    		'exception_template'       => 'error/index',
    		'template_map' => array(
    				'layout/layout'           => __DIR__ . '/../view/layout/empty.phtml',
    				'produto-public/index/index' => __DIR__ . '/../view/produto-public/index/index.phtml',
    				'error/404'               => __DIR__ . '/../view/error/404.phtml',
    				'error/index'             => __DIR__ . '/../view/error/index.phtml',
    		),
    		'template_path_stack' => array(
    				__DIR__ . '/../view',
    		),
    ),
);