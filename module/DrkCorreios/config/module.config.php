<?php
return array(
    'router' => array(
        'routes' => array(
            'correio-cep' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/correios/restCep',
                    'defaults' => array(                       
                        'controller' => 'DrkCorreios\Controller\CurlRest',        
                        'action' => 'getList'
                    ),
                ),
            ),
            'correio-frete' => array(
            		'type' => 'Zend\Mvc\Router\Http\Literal',
            		'options' => array(
            				'route'    => '/correios/frete',
            				'defaults' => array(
            						'controller' => 'DrkCorreios\Controller\Index',
            				        'action' => 'index'
            				),
            		),
                    'may_terminate' => true,
                'child_routes' => array(
                    'correio-frete-total' => array(
                    		'type' => 'Zend\Mvc\Router\Http\Literal',
                    		'options' => array(
                    				'route'    => '/total',
                    				'defaults' => array(
                    						'controller' => 'DrkCorreios\Controller\Index',
                    						'action' => 'total'
                    				),
                    		)
                    ),
                )
            ),
        ),
    ),
    'controllers' => array(
    		'invokables' => array(
    				'DrkCorreios\Controller\CurlRest' => 'DrkCorreios\Controller\CurlRestController',
    		        'DrkCorreios\Controller\Index' => 'DrkCorreios\Controller\IndexController'
    		),
    ),
    'view_manager' => array(
    	'strategies' => array(
            'ViewJsonStrategy'
        )
    ),
    'view_manager' => array(
    		'display_not_found_reason' => true,
    		'display_exceptions'       => true,
    		'doctype'                  => 'HTML5',
    		'not_found_template'       => 'error/404',
    		'exception_template'       => 'error/index',
    		'template_map' => array(
    				'layout/layout'           => __DIR__ . '/../view/layout/empty.phtml',
    				'CarrinhoCompras/index/index' => __DIR__ . '/../view/CarrinhoCompras/index/index.phtml',
    				'error/404'               => __DIR__ . '/../view/error/404.phtml',
    				'error/index'             => __DIR__ . '/../view/error/index.phtml',
    		),
    		'template_path_stack' => array(
    				__DIR__ . '/../view',
    		),
    ),
);