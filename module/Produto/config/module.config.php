<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Produto;

return array(
    'router' => array(
        'routes' => array(
            /*
             * Rotas Administrativas
             */
        	 'admin-produto-home' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/administrador/produto',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Produto\Controller',
                        'controller'    => 'Produto',
                        'action'        => 'index',                        
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'admin-default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action[/:id]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                    'admin-page' => array(
                		'type'    => 'Segment',
                		'options' => array(
            				'route'    => '/[page/:page]',
            				'constraints' => array(
        						'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
        						'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
            				),
            				'defaults' => array(
            				    'controller'    => 'Produto',
            				    'action'        => 'index',
            				    'page'          => 1
            				),
                		),
                    ),
                    'admin-produto-adicionar' => array(
                		'type'    => 'Segment',
                		'options' => array(
            				'route'    => '/[:action]',
            				'constraints' => array(
        						'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
        						'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
            				),
            				'defaults' => array(
            				    
            				),
                		),
                    ),
                    'admin-categorias-default' => array(
                        'type'    => 'Segment',
                    	'options' => array(
                    	    'route'    => '[/categorias/:slug]',
                        	'constraints' => array(                        		    		
                        	    #'slug' => '[a-zA-Z][a-zA-Z-]*'
                        	),
                    		'defaults' => array(
                    		    'controller' => "Categoria",
                    			'action'     => 'listaProdutosByCategoria',
                    		),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'admin-categorias-e-subcategoria' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'     => '[/subcategoria/:slugSub]',
                                    'defaults'  => array(
                                        'controller' => 'Categoria',
                                        'action'     => 'listaProdutosBySubcategoria',
                                    ),
                                ),                               
                            ),
                        ),
                    ),
                ),
            ),
            'admin-produto-categoria' => array(
            		'type'    => 'Literal',
            		'options' => array(
            				'route'    => '/administrador/categorias',
            				'defaults' => array(
            						'__NAMESPACE__' => 'Produto\Controller',
            						'controller'    => 'Categoria',
            						'action'        => 'index',
            				),
            		),
                    'may_terminate' => true,
                    'child_routes' => array(
                    		'admin-produto-categoria-action' => array(
                    				'type'    => 'Segment',
                    				'options' => array(
                    						'route'    => '[/:action]',
                    						'constraints' => array(
                    								'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    						),
                    						'defaults' => array(
                    						),
                    				),
                    		),
                    ),
               ), 
            'admin-produto-referencia' => array(
            		'type'    => 'Literal',
            		'options' => array(
            				'route'    => '/administrador/referencia',
            				'defaults' => array(
            						'__NAMESPACE__' => 'Produto\Controller',
            						'controller'    => 'Referencia',
            						'action'        => 'index',
            				),
            		),
            		'may_terminate' => true,
            		'child_routes' => array(
            				'admin-produto-categoria-action' => array(
            						'type'    => 'Segment',
            						'options' => array(
            								'route'    => '[/:action]',
            								'constraints' => array(
            										'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
            								),
            								'defaults' => array(
            								),
            						),
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
            'Produto\Controller\Produto' => 'Produto\Controller\ProdutoController',
            'Produto\Controller\Categoria' => 'Produto\Controller\CategoriaController',
            'Produto\Controller\Referencia' => 'Produto\Controller\ReferenciaController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'Layout/adminProduto_logado_adm'           => __DIR__ . '/../view/layout/layout.phtml',
            'produto/index/index' => __DIR__ . '/../view/produto/index/index.phtml',
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
