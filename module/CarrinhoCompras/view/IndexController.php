<?php

namespace Pagseguro\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;




class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $viewModel = new ViewModel();
         $viewModel->setTerminal(true);
        return $viewModel;
    }
    public function compraTesteAction()
    {
    	$service = $this->getServiceLocator()->get("Pagseguro\Curl\post");
        $viewModel = new ViewModel(array("codeToken" => $service->requisicao()));
        $viewModel->setTerminal(true);
        return $viewModel;
    }
    public function gerarTokenAction()
    {
        $service = $this->getServiceLocator()->get("Pagseguro\Curl\post");
        $viewModel = new ViewModel(array("codeToken" => $service->requisicao()));
        $viewModel->setTerminal(true);
        return $viewModel;
    }
    
}

