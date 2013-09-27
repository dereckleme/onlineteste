<?php
namespace Base\Service;

class Caminho
{
    protected $serviceManager;
    protected $matchedRoute;
    protected $controller;
   

	public function __construct($serviceManager)
    {
    	$this->serviceManager = $serviceManager;
    }
    public function geraCaminho()
    {
        if($this->matchedRoute == "publico-categoria")
        {
            $repository = $this->serviceManager->get("Produto\Repository\Categorias");
            $name = $this->controller->params()->fromRoute('categoriaslug');
            $append = $repository->findOneByslug($name);
            if(!empty($append))
            {
                $data[] = '<a class="txt_breadcrumbs" href="'.$this->controller->url()->fromRoute("home").'">Pagina Inicial</a> ';
            	$data[] = '<a class="txt_breadcrumbs" href="'.$this->controller->url()->fromRoute("publico-categoria",array('categoriaslug' => $append->getSlug())).'"><span class="txt_pagina">'.$append->getNome().'</span></a> ';
            }
        	return $data;
        }
        else if($this->matchedRoute == "publico-categoria/publico-categoria-e-subcategoria")
        {
            $repository = $this->serviceManager->get("Produto\Repository\SubCategorias");
            $name = $this->controller->params()->fromRoute('subcategoriaslugSub');
            $append = $repository->findOneByslugSubcategoria($name);
            if(!empty($append))
            {
                $data[] = '<a class="txt_breadcrumbs" href="'.$this->controller->url()->fromRoute("home").'">Pagina Inicial</a> ';
                $data[] = '<a class="txt_breadcrumbs" href="'.$this->controller->url()->fromRoute("publico-categoria",array('categoriaslug' => $append->getCategorias()->getSlug())).'">'.$append->getCategorias()->getNome().'</a> ';
            	$data[] = '<a class="txt_breadcrumbs" href="'.$this->controller->url()->fromRoute("publico-categoria/publico-categoria-e-subcategoria", array("categoriaslug" => $append->getCategorias()->getSlug(), "subcategoriaslugSub" => $append->getSlugSubcategoria())).'"><span class="txt_pagina">'.$append->getNome().'</span></a> ';
            }
            return $data;
        }
        else if($this->matchedRoute == "publico-categoria/publico-categoria-e-subcategoria/publico-produto")
        {    
            $repository = $this->serviceManager->get("Produto\Repository\Produtos");
            $name = $this->controller->params()->fromRoute('produtoSlug');
            $append = $repository->findOneByslugProduto($name);
            if(!empty($append))
            {
                $data[] = '<a class="txt_breadcrumbs" href="'.$this->controller->url()->fromRoute("home").'">Pagina Inicial</a> ';
                $data[] = '<a class="txt_breadcrumbs" href="'.$this->controller->url()->fromRoute("publico-categoria",array('categoriaslug' => $append->getProdutosubcategoria()->getCategorias()->getSlug())).'">'.$append->getProdutosubcategoria()->getCategorias()->getNome().'</a> ';
                $data[] = '<a class="txt_breadcrumbs" href="'.$this->controller->url()->fromRoute("publico-categoria/publico-categoria-e-subcategoria", array("categoriaslug" => $append->getProdutosubcategoria()->getCategorias()->getSlug(), "subcategoriaslugSub" => $append->getProdutosubcategoria()->getSlugSubcategoria())).'">'.$append->getProdutosubcategoria()->getNome().'</a> ';
                $data[] = '<a class="txt_breadcrumbs" href="'.$this->controller->url()->fromRoute("publico-categoria/publico-categoria-e-subcategoria/publico-produto",array("categoriaslug" => $append->getProdutosubcategoria()->getCategorias()->getSlug(), "subcategoriaslugSub" => $append->getProdutosubcategoria()->getSlugSubcategoria(), "produtoSlug" => $append->getSlugProduto())).'"><span class="txt_pagina">'.$append->getTitulo().'</span></a> ';
            }
             return $data;
        }
        else if($this->matchedRoute == "publico-carrinho-compra")
        {
            $data[] = '<a class="txt_breadcrumbs" href="'.$this->controller->url()->fromRoute("home").'">Pagina Inicial</a> ';
            $data[] = '<a class="txt_breadcrumbs" href=""><span class="txt_pagina">Minha Cesta</span></a> ';
            return $data;
        }
        else if($this->matchedRoute == "publico-finaliza-compra")
        {
        	$data[] = '<a class="txt_breadcrumbs" href="'.$this->controller->url()->fromRoute("home").'">Pagina Inicial</a> ';
        	$data[] = '<a class="txt_breadcrumbs" href=""><span class="txt_pagina">Finalizar Compra</span></a> ';
        	return $data;
        }
        else if($this->matchedRoute == "Painel-usuario")
        {
        	$data[] = '<a class="txt_breadcrumbs" href="'.$this->controller->url()->fromRoute("home").'">Site</a> ';
        	$data[] = '<a class="txt_breadcrumbs" href=""><span class="txt_pagina">Acompanhar meus pedidos</span></a> ';
        	return $data;
        }
        else if($this->matchedRoute == "Painel-usuario/Painel-usuario-recibo")
        {
        	$data[] = '<a class="txt_breadcrumbs" href="'.$this->controller->url()->fromRoute("home").'">Site</a> ';
        	$data[] = '<a class="txt_breadcrumbs" href="'.$this->controller->url()->fromRoute("Painel-usuario").'"><span class="txt_pagina">Acompanhar Pedidos</span></a> ';
        	$data[] = '<a class="txt_breadcrumbs" href=""><span class="txt_pagina">Detalhe do Pedido</span></a> ';
        	return $data;
        }
        else if($this->matchedRoute == "home")
        {
            return array('<a class="txt_breadcrumbs" href=""><span class="txt_pagina">Pagina Inicial</span></a> ');
        }   
    	return array();
    }
	public function setMatchedRoute($matchedRoute) {
		$this->matchedRoute = $matchedRoute;
	}
	public function setRepository($repository) {
		$this->repository = $repository;
	}
	public function setServiceManager($serviceManager) {
		$this->serviceManager = $serviceManager;
	}

	public function setController($controller) {
		$this->controller = $controller;
	}

	
}

?>