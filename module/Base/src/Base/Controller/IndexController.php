<?php

/**
 * dereck
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator as ZendPaginator,
    Zend\Paginator\Adapter\ArrayAdapter;


use Zend\View\Helper\Url;


class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $repository = $this->getServiceLocator()->get('Produto\Repository\Produtos');
        $prodVisistados = $repository->findByGetVisitados();
        
        $prodDestaques = $repository->findByDestaque(1);        
        shuffle($prodDestaques);
        return new ViewModel(array(
            'prodDestaques'    =>    $prodDestaques,
            'prodVisistados'   =>    $prodVisistados 
        ));
    }
    
    public function categoriaAction()
    {      
        #$page = ( $this->params()->fromRoute('page') == "" || $this->params()->fromRoute('page') == 0) ? 1 : ( ( $this->params()->fromRoute('page') - 1 ) * 1);
        if($this->params()->fromQuery('page') > 0)
        {
        	$pagePaginator = $this->params()->fromQuery('page');
        	$page = ($this->params()->fromQuery('page') - 1) * 1;
        }
        else 
        {
            $pagePaginator = 1;
            $page = 0;
        }        
        $busca = $this->params()->fromRoute('categoriaslug',0);
        
        $repository = $this->getServiceLocator()->get("Produto\Repository\Produtos");
        $repository->setSlugCategoria($busca);
        $countCategoria = $repository->categoriaCountRow();
        $categoriaBySlug = $repository->productForCategory(1, $page);        
        
        if(count($categoriaBySlug) > 0)
        {
            $paginator = new ZendPaginator(new ArrayAdapter($countCategoria));
            $paginator->setCurrentPageNumber($pagePaginator);
            $paginator->setDefaultItemCountPerPage(2);
            
            return new ViewModel(array("produtosPorCategoria"=>$categoriaBySlug, 'page'=>$paginator, 'termo'=>$busca));
        }
        else 
        {
            return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));          
        }
    }
    
    public function categoriaAndSubAction()
    {
        if($this->params()->fromQuery('page') > 0)
        {
        	$pagePaginator = $this->params()->fromQuery('page');
        	$page = ($this->params()->fromQuery('page') - 1) * 1;
        }
        else
        {
        	$pagePaginator = 1;
        	$page = 0;
        }
        
        $slugCatBusca = $this->params()->fromRoute('categoriaslug',0);
        $slugSubcatBusca = $this->params()->fromRoute('subcategoriaslugSub',0);
        
        $repository = $this->getServiceLocator()->get('Produto\Repository\Produtos');
        $repository->setSlugCategoria($slugCatBusca);
        $repository->setSlugSubcategoria($slugSubcatBusca);
        
        $countSub = $repository->subCountRow();
        $subCatBySlug = $repository->productForCatAndSub(1, $page);
        
        if(count($subCatBySlug) > 0)
        {
            $paginator = new ZendPaginator(new ArrayAdapter($countSub));
            $paginator->setCurrentPageNumber($pagePaginator);
            $paginator->setDefaultItemCountPerPage(1);
            
            return new ViewModel(array(
                'produtosPorSubCategoria'=>$subCatBySlug, 
                'page'=>$paginator, 
                'termo'=>$this->params()->fromRoute('subcategoriaslugSub',0)            
            ));
        }
        else 
        {
            return $this->redirect()->toRoute('home');
        }
        
    }
    
    public function produtoAction()
    {
        $params = $this->params();
        $repository = $this->getServiceLocator()->get("Produto\Repository\Produtos");
            $repository->setSlugProduto($params->fromRoute("produtoSlug"));
            $repository->setSlugSubcategoria($params->fromRoute("subcategoriaslugSub"));
            $return = $repository->detalheProduto();
            if(count($return) == 1)
            {                
                $service = $this->getServiceLocator()->get('Produto\Service\Produto');
                $visitas = $repository->findBySlugProduto($params->fromRoute("produtoSlug"));                
                $newQtd = $visitas[0]->getAcessos() + 1;
                $data = array(
                    'id'  => $visitas[0]->getIdproduto(),
                    'titulo'  => $visitas[0]->getTitulo(),
                    'slugProduto'  => $visitas[0]->getSlugProduto(),
                    'valor'  => number_format($visitas[0]->getValor(),2,',','.'),
                    'produtosubcategoria'  => $visitas[0]->getProdutosubcategoria(),
                    'destaque'  => $visitas[0]->getDestaque(),
                    'ativo'  => $visitas[0]->getAtivo(),
                    'acessos'  => $newQtd,
                );            
                $service->update($data);
                
                $relacionados =  $repository->produtosRelacionados();
    	        return new ViewModel(array('detalheProduto' => $return,'produtosRelacionados' => $relacionados ));
            }
            else
            {
                return $this->redirect()->toRoute('home');
            }    
    }
    
    public function autocompleteAction()
    {
        if($this->params()->fromQuery('term') != "")
        {
            $repository = $this->getServiceLocator()->get("Produto\Repository\Produtos");                
            $repository->setSearch($this->params()->fromQuery('term'));
            $resultado = $repository->buscaProdutosAutoComplete();
            
            if(count($resultado))
            {
                $i = 1;
                foreach($resultado as $values)
                {
                    foreach($values as $key => $value)
                    {
                        if($i == 1)
                        {
                            $termos["label"] = $value;
                        }
                        else
                        {   
                            $termos["label$i"] = $value;                        
                        }                    
                        $i++;
                    }            	
                }            
                $termos = json_encode($termos);
            }
            else
            {
                $termos = json_encode(array("label"=>"não há sugestões"));
            }
            
            $viewModel = new ViewModel(array('termos' => $termos)); // chama uma view
            $viewModel->setTerminal(true); // desativa layout.phtml
            return $viewModel;            
        }
        else
        {
            return $this->redirect()->toRoute('home');
        }
        
    }
    
    public function buscaDeProdutosAction()
    {
        $page = ($this->params()->fromQuery('pagina') == "") ? 1 : $this->params()->fromQuery('pagina');        
        $ordem = $this->params()->fromQuery('ordenarPor');
        $busca = $this->params()->fromQuery('p');
        $item = $this->params()->fromQuery('item');
        
        $repository = $this->getServiceLocator()->get("Produto\Repository\Produtos");
        if($busca)
        {
            $repository->setSearch($busca);
        }
        if($item)
        {
            $repository->setItem($item);
        }
        $countResultado = $repository->resultadoBuscaRows($ordem);
        $pagePart =  ($this->params()->fromQuery('pagina') == "") ? 0 : (($this->params()->fromQuery('pagina') - 1) * 1);
        $resultado = $repository->resultadoBusca($ordem, 1, $pagePart);
                
        if(count($resultado) > 0)
        {
            $paginator = new ZendPaginator(new ArrayAdapter($countResultado));
            $paginator->setCurrentPageNumber($page);
            $paginator->setDefaultItemCountPerPage(1);
            
            return new ViewModel(array(
                "resultado"    =>    $resultado,
                "termo"        =>    $busca,
                "item"         =>    $item,
                "ordenarPor"   =>    $ordem,
                "page"         =>    $paginator,
                "pagina"       =>    $page                
            ));
        }
        else
        {
            return new ViewModel(array("semresultado"=>$busca));
        }
        
    }
    public function duvidasAction()
    {
        return new ViewModel();
    }
}