<?php

namespace Produto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ReferenciaController extends AbstractActionController
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
                if(!empty($postData['eventReferencia']))
                {
                    
        	$service = $this->getServiceLocator()->get('Produto\Service\Referencia');
        	$service->insert(array("nomeReferencia" => $postData['eventReferencia']));
        	$viewModel = new ViewModel(); // chama uma view
        	
                }
                else 
                {
                    $viewModel = new ViewModel(array("mensagem" => "- Campo nome da referencia está em branco.")); // chama uma view
                }    
        }
        else
        {
            $viewModel = new ViewModel(array("mensagem" => "error")); // chama uma view
        }    
        $viewModel->setTerminal(true); // desativa layout.phtml
        return $viewModel;
    }
}

