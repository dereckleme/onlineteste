<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Usuario;
return array(
    'router' => array(
        'routes' => array(  
             'Usuario' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/actionUser',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Usuario\Controller',
                        'controller'    => 'Usuario',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'UsuarioAction' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'Painel-usuario' => array(
            		'type'    => 'Literal',
            		'options' => array(
            				'route'    => '/painel',
            				'defaults' => array(
            						'__NAMESPACE__' => 'Usuario\Controller',
            						'controller'    => 'Usuario',
            						'action'        => 'index',
            				),
            		),
                    'may_terminate' => true,
                    'child_routes' => array(
                        'Painel-usuario-recibo' => array(
                        		'type'    => 'Segment',
                        		'options' => array(
                        				'route'    => '[/pedido[/:idPedido]]',
                        				'defaults' => array(
                        						'__NAMESPACE__' => 'Usuario\Controller',
                        						'controller'    => 'Usuario',
                        						'action'        => 'pedido',
                        				),
                        		),
                        		'may_terminate' => true,
                        		'child_routes' => array(
                        
                        		)
                        ),
                        'Painel-usuario-status' => array(
                        		'type'    => 'Segment',
                        		'options' => array(
                        				'route'    => '[/status[/:idPedido]]',
                        				'defaults' => array(
                        						'__NAMESPACE__' => 'Usuario\Controller',
                        						'controller'    => 'Usuario',
                        						'action'        => 'status',
                        				),
                        		),
                        		'may_terminate' => true,
                        		'child_routes' => array(
                        
                        		)
                        )
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
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Usuario\Controller\Usuario' => 'Usuario\Controller\UsuarioController',
            'Usuario\Controller\Login' => 'Usuario\Controller\LoginController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'layout/layout_logado'           => __DIR__ . '/../view/layout/layout.phtml',
            'Usuario/index/index' => __DIR__ . '/../view/Usuario/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'doctrine' => array(
    		'driver' => array(
    				'application_entities' => array(
    						'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
    						'cache' => 'array',
    						'paths' => array(__DIR__ . '/../src/Usuario/Entity')
    				),
    
    				'orm_default' => array(
    						'drivers' => array(
    								'Usuario\Entity' => 'application_entities'
    						)
    				))),
	'data-fixture' => array(
			'SONUser_fixture' => __DIR__ . '/../src/Usuario/Fixture',
	),
);
