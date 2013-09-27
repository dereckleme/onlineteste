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
        return new ViewModel(array("codeToken" => $service->requisicao()));
    }
    public function gerarTokenAction()
    {
        $service = $this->getServiceLocator()->get("Pagseguro\Curl\post");
        $viewModel = new ViewModel(array("codeToken" => $service->requisicao()));
        $viewModel->setTerminal(true);
        return $viewModel;
    }
    /*
     * Retorno Pagseguro Action
     */
    public function retornoAction()
    {
        $request = $this->getRequest();
            if($request->isPost())
            {
                $data = $request->getPost()->toArray();
                $service = $this->getServiceLocator()->get("Pagseguro\Curl\Retorno");
                $return = $service->requisicao($data['notificationCode']);
                #$return = $service->requisicao("4FEA8E-AF8A178A179B-A004FA4FA4D0-6B204F");
                $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                $repositoryRecibo = $em->getRepository("Pagamento\Entity\PagamentoControlerecibo");
                $service = $this->getServiceLocator()->get("Pagseguro\Service\Pagseguro");
              
                    $objectRelacional = $repositoryRecibo->findOneByidcontrolerecibo($return['reference']);
                
                if(count($objectRelacional) == 0) // nao existe
                {
                	$service->insert(array("npedido" => $return['code'],"Setspagamento" => $return['status'], "SetfPagamento" => $return['paymentMethod']['type'], "valor" => $return['grossAmount']));
                }
                else
                {
                    $service->update(array("id" => $objectRelacional->getIdcontrolerecibo(),"Setspagamento" => $return['status'], "SetfPagamento" => $return['paymentMethod']['type']));      	     
                }
            }    
    	return new ViewModel();
    }
}

