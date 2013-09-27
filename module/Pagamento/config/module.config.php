<?php
namespace Pagamento;
return array(
    'router' => array(
    		'routes' => array(
    		    'admin-financeiro' => array(
    		    		'type'    => 'Literal',
    		    		'options' => array(
    		    				'route'    => '/administrador/financeiro',
    		    				'defaults' => array(
    		    						'__NAMESPACE__' => 'Pagamento\Controller',
    		    						'controller'    => 'Financeiro',
    		    						'action'        => 'index',
    		    				),
    		    		),
    		    		'may_terminate' => true,
    		    		'child_routes' => array(
    		    				'admin-financeiro-action' => array(
    		    						'type'    => 'Segment',
    		    						'options' => array(
    		    								'route'    => '[/detalhePedido/:idpedido]',
    		    								'constraints' => array(
    		    										
    		    								),
    		    								'defaults' => array(
    		    								    "action" => 'detalhePedido'
    		    								),
    		    						),
    		    				),
    		    		),
    		    ),
    		    'admin-estoque' => array(
    		    		'type'    => 'Literal',
    		    		'options' => array(
    		    		    'route'    => '/administrador/estoque',
    		    		    'defaults' => array(
    		    		        '__NAMESPACE__' => 'Pagamento\Controller',
    		    		        'controller'    => 'Estoque',
    		    		        'action'        => 'index',
    		    	        ),
    		    	    ),    		            
    		        ),
    		    'publico-fechar-pedido' => array(
    		    		'type' => 'Literal',
    		    		'options' => array(
    		    				'route'    => '/compra/concluirPedido',
    		    				'defaults' => array(
    		    						'__NAMESPACE__' => 'Pagamento\Controller',
            		    		        'controller'    => 'Financeiro',
    		    						'action'        => 'fecharPedido',
    		    				),
    		    		),
    		    ),
    		    ),
        ),
    'service_manager' => array(
    		'abstract_factories' => array(
    				'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
    				'Zend\Log\LoggerAbstractServiceFactory',
    		),
    		'aliases' => array(
    				'translator' => 'MvcTranslator',
    		),
    ),
    'controllers' => array(
    		'invokables' => array(
    			'Pagamento\Controller\Financeiro' => 'Pagamento\Controller\FinanceiroController',
    		    'Pagamento\Controller\Estoque' => 'Pagamento\Controller\EstoqueController',
    		),
    ),
    'view_manager' => array(
    		'display_not_found_reason' => true,
    		'display_exceptions'       => true,
    		'doctype'                  => 'HTML5',
    		'not_found_template'       => 'error/404',
    		'exception_template'       => 'error/index',
    		'template_map' => array(
    		        'Layout/admin_logado'           => __DIR__ . '/../view/layout/index_logado.phtml',
    				'Layout/admin_logado_adm'           => __DIR__ . '/../view/layout/layout.phtml',
    				'Pagamento/index/index' => __DIR__ . '/../view/pagamento/index/index.phtml',
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