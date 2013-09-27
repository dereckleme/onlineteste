<?php
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Base\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'admin-administrador' => array(
            		'type' => 'Zend\Mvc\Router\Http\Literal',
            		'options' => array(
            				'route'    => '/administrador',
            				'defaults' => array(
            						'controller' => 'Base\Controller\Compra',
            						'action'     => 'index',
            				),
            		),
            ),
            'publico-carrinho-compra' => array(
            		'type' => 'Literal',
            		'options' => array(
            				'route'    => '/carrinho-compra',
            				'defaults' => array(
            						'__NAMESPACE__' => 'Base\Controller',
            						'controller'    => 'Compra',
            						'action'        => 'index',
            				),
            		),
            ),
            'publico-finaliza-compra' => array(
            		'type' => 'Literal',
            		'options' => array(
            				'route'    => '/finaliza-compra',
            				'defaults' => array(
            						'__NAMESPACE__' => 'Base\Controller',
            						'controller'    => 'Compra',
            						'action'        => 'finaliza',
            				),
            		),
            ),
            'publico-produto-estoque' => array(
            		'type' => 'Literal',
            		'options' => array(
            				'route'    => '/estoque',
            				'defaults' => array(
            						'__NAMESPACE__' => 'Base\Controller',
            						'controller'    => 'Compra',
            						'action'        => 'getEstoque',
            				),
            		),
            ),
            'publico-categoria' => array(
            	'type'    => 'Segment',
            	'options' => array(
            		#'route'    => '/[produto/:categoriaslug[/page/:page]]',
            	    'route'    => '/[produto/:categoriaslug]',
            		'defaults' => array(
            			'__NAMESPACE__' => 'Base\Controller',
            			'controller'    => 'Index',
            			'action'        => 'categoria',
            		    #'page'          => '1'
            		),
            	),
                'may_terminate' => true,
                'child_routes' => array(
                    'publico-categoria-e-subcategoria' => array(
                	    'type'    => 'Segment',
                		'options' => array(
                		    'route'     => '[/:subcategoriaslugSub]',
                			'defaults'  => array(
                				'controller' => 'Index',
                				'action'     => 'categoriaAndSub',
                			),
                		),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'publico-produto' => array(
                            		'type' => 'Segment',
                            		'options' => array(
                            				'route'    => '[/:produtoSlug]',
                            				'defaults' => array(
                            						'controller' => 'Index',
                            						'action'     => 'produto',
                            				),
                            		),
                            ),
                        )    
                    ),
                ),
            ),
            'publico-busca-autocomplete' => array(
        		'type' => 'Literal',
        		'options' => array(
    				'route'    => '/autocomplete/',
    				'defaults' => array(
						'__NAMESPACE__' => 'Base\Controller',
						'controller'    => 'Index',
						'action'        => 'autocomplete',
    				),
        		),
            ),
            'publico-busca-produto' => array(        		
                'type'    => 'Segment',
        		'options' => array(
    				'route'    => '/busca/',
    				'defaults' => array(
						'__NAMESPACE__' => 'Base\Controller',
						'controller'    => 'Index',
						'action'        => 'buscaDeProdutos'
    				),
        		),
            ),
            'publico-duvidas' => array(
            		'type'    => 'Segment',
            		'options' => array(
            				'route'    => '/duvidas_frequentes',
            				'defaults' => array(
            						'__NAMESPACE__' => 'Base\Controller',
            						'controller'    => 'Index',
            						'action'        => 'duvidas'
            				),
            		),
            ),
            'publico-mapeamento-cidades-estados' => array(
                'type'    => 'Segment',
                'options' => array(
                		'route'    => '/mapeamento-cidades-estados',
                		#'route'    => '/[produto/:categoriaslug]',
                		'defaults' => array(
                				'__NAMESPACE__' => 'Base\Controller',
                				'controller'    => 'Mapeamento',
                				'action'        => 'index'
                		),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'publico-mapeamento-cidade-id' => array(
                    		'type' => 'Segment',
                    		'options' => array(
                    				'route'    => '[/cidade/id/:idCidade]',
                    				'defaults' => array(
                    						'action'     => 'index',
                    				),
                    		),
                    ),
                    'publico-mapeamento-cidade-estado-lista' => array(
                    		'type' => 'Segment',
                    		'options' => array(
                    				'route'    => '[/cidade/nomeclatura/:nomeclatura]',
                    				'defaults' => array(
                    						'action'     => 'index',
                    				),
                    		),
                    ),
                )    
            )    
        ),
    ),
    'controllers' => array(
    		'invokables' => array(
    		        'Base\Controller\Compra' => 'Base\Controller\CompraController',
    				'Base\Controller\Index' => 'Base\Controller\IndexController',
    		        'Base\Controller\Mapeamento' => 'Base\Controller\MapeamentoController'
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
    				'layout/site'           => __DIR__ . '/../view/layout/index.phtml',
    		        'layout/site_logado'           => __DIR__ . '/../view/layout/index_logado.phtml',
    		        'layout/site_logado_adm'           => __DIR__ . '/../view/layout/index_logado_adm.phtml',
    		        'layout/carrinho'                   => __DIR__ . '/../view/layout/layoutCarrinho.phtml',
    		    'layout/caminho'                   => __DIR__ . '/../view/layout/caminho.phtml',
    				'base/index/index' => __DIR__ . '/../view/base/index/index.phtml',
    				'error/404'               => __DIR__ . '/../view/error/404.phtml',
    				'error/index'             => __DIR__ . '/../view/error/index.phtml',
    		),
    		'template_path_stack' => array(
    				__DIR__ . '/../view',
    		),
    ),
);