<?php

namespace Produto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\DBAL\Schema\View;
use Produto\Form\Produto as FrmProduto;

class CategoriaController extends AbstractActionController
{

    public function indexAction()
    {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("Produto\Entity\ProdutoCategorias");
        return new ViewModel(array("data" => $repository->findAll()));
    }
    public function insertAction()
    {
        $request = $this->getRequest();
        if($request->isPost())
        {
            $postData = $request->getPost()->toArray();
                if(!empty($postData['eventCategoria']))
                {
        	$service = $this->getServiceLocator()->get('Produto\Service\Categoria');
        	$service->insert(array("nome" => $postData['eventCategoria']));
        	$viewModel = new ViewModel(); // chama uma view
                }
                else 
                {
                    $viewModel = new ViewModel(array("mensagem" => "- Campo nome da categoria está em branco.")); // chama uma view
                }    
        }    
        $viewModel->setTerminal(true); // desativa layout.phtml
        return $viewModel;
    }
    public function insertSubAction()
    {
        $request = $this->getRequest();
        if($request->isPost())
        {
            $postData = $request->getPost()->toArray();
                if(!empty($postData['eventCategoria']) && !empty($postData['eventSubcategoria']))
                {
                    $service = $this->getServiceLocator()->get('Produto\Service\Subcategoria');
                    $service->insert(array("nome" => $postData['eventSubcategoria'], "eventCategoria" => $postData['eventCategoria']));
                    $viewModel = new ViewModel(); // chama uma view
                }else {
                    $viewModel = new ViewModel(array("mensagem" => "- Existe algum campo em branco.")); // chama uma view
                }
            
        }
        $viewModel->setTerminal(true); // desativa layout.phtml
        return $viewModel;
    }
    
    public function listaProdutosByCategoriaAction()
    {
        $busca = $this->params()->fromRoute('slug',0);
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repository = $em->getRepository("Produto\Entity\ProdutoCategorias");
        
        $categoriaBySlug = $repository->findByslug($busca);
        
        $form = new FrmProduto;
        return new ViewModel(array("dataCategorias"=>$categoriaBySlug, "categorias"=>$repository->findAll(), "catActive"=>$busca, "form"=>$form ));
    }
    
    public function listaProdutosBySubcategoriaAction()
    {
    	die('byCLS');
    }
    
}

