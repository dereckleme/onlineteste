<?php

namespace CarrinhoCompras\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    private $carrinho;
    public function insertAction()
    {
        $request = $this->getRequest();
        if($request->isPost())
        {
            $data = $request->getPost()->toArray();
            $service = $this->getServiceLocator()->get("CarrinhoCompras\Service\Carrinho");
            $service->setIdProduto($data['actionAddCart']);
            $service->setQuantProduto($data['actionQuant']);
            $service->adiciona();
        }
        $view = new ViewModel();
        $view->setTerminal(true);
    	return $view;
    }
    public function deleteAction()
    {
        $request = $this->getRequest();
        if($request->isPost())
        {
            $data = $request->getPost()->toArray();
            $service = $this->getServiceLocator()->get("CarrinhoCompras\Service\Carrinho");
            $service->setIdProduto($data['actionAddCart']);
            $service->exclui();
        }
        return new ViewModel();
    }
    public function listAction()
    {
        $this->layout('layout/carrinho');
        return new ViewModel();
    }
    public function detalheCarrinhoAction()
    {
        $service = $this->getServiceLocator()->get("CarrinhoCompras\Model\Carrinho");
        $view = new ViewModel(array("valorTotal" => $service->calculoTotal()));
        $view->setTerminal(true);
        return $view;
    }
}

