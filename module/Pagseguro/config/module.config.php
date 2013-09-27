<?php

namespace Pagseguro;
return array(
    'router' => array(
        'routes' => array(
            'pagseguro-retorno' => array(
            		'type' => 'Zend\Mvc\Router\Http\Literal',
            		'options' => array(
            				'route'    => '/pagseguro/retorno',
            				'defaults' => array(
            				        '__NAMESPACE__' => 'Pagseguro\Controller',
            						'controller' => 'Index',
            						'action'     => 'retorno',
            				),
            		),
            ),
            'pagseguro-token' => array(
            		'type' => 'Literal',
            		'options' => array(
            				'route'    => '/pagseguro/gerarToken',
            				'defaults' => array(
            						'controller' => 'Pagseguro\Controller\Index',
            						'action'     => 'gerarToken',
            				),
            		),
            ),
            'pagseguro-teste' => array(
            		'type' => 'Zend\Mvc\Router\Http\Literal',
            		'options' => array(
            				'route'    => '/pagseguro/compraTeste',
            				'defaults' => array(
            						'controller' => 'Pagseguro\Controller\Index',
            						'action'     => 'gerarToken',
            				),
            		),
            ),
        ),
    ),
    'controllers' => array(
    		'invokables' => array(
    				'Pagseguro\Controller\Index' => 'Pagseguro\Controller\IndexController'
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
    				'Pagseguro/index/index' => __DIR__ . '/../view/pagseguro/index/index.phtml',
    				'error/404'               => __DIR__ . '/../view/error/404.phtml',
    				'error/index'             => __DIR__ . '/../view/error/index.phtml',
    		),
    		'template_path_stack' => array(
    				__DIR__ . '/../view',
    		),
    ),
    'doctrine' => array(
    		'eventmanager' => array(
    				'orm_default' => array(
    						'subscribers' => array(
    								// pick any listeners you need
    								'Gedmo\Tree\TreeListener',
    								'Gedmo\Timestampable\TimestampableListener',
    								'Gedmo\Sluggable\SluggableListener',
    								'Gedmo\Loggable\LoggableListener',
    								'Gedmo\Sortable\SortableListener'
    						),
    				),
    		),
    		'driver' => array(
    				__NAMESPACE__ . '_driver' => array(
    						'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
    						'cache' => 'array',
    						'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
    				),
    				'orm_default' => array(
    						'drivers' => array(
    								__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
    						),
    				),
    		),
    ),
);