<?php

namespace DrkCorreios\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Config\Reader\Xml;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;
class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $request = $this->getRequest();
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage("Usuario"));
        $errorVerify = false;
        $valorFrete = null;
        if($request->isPost())
            {
                $xml = new Xml();
                $postData = $request->getPost()->toArray();
                $serviceFrete = $this->getServiceLocator()->get("DrkCorreios\Service\Frete");
                $serviceFrete->setSCepDestino($postData['cep']);
                $freteCalculo = $xml->fromString($serviceFrete->calcularFrete());
                if($freteCalculo['cServico']['Erro'] == 0)
                {
                	$valorFrete = $valorFrete+str_replace(",", ".", $freteCalculo['cServico']['Valor']);
                }
                else
                {
                	$errorVerify = true;
                }
                if($errorVerify)
                {
                	$dataInfo = "Indisponível";
                }
                else
                {
                	$filter = new \NumberFormatter('pt_BR', \NumberFormatter::CURRENCY);
                	$dataInfo = $filter->format($valorFrete);
                }
                $viewModel = new ViewModel(array("data" => $dataInfo));
                $viewModel->setTerminal(true);
                return $viewModel;
            }
        
    }
    public function totalAction()
    {
    	$request = $this->getRequest();
    	$auth = new AuthenticationService;
    	$auth->setStorage(new SessionStorage("Usuario"));
    	$errorVerify = false;
    	$valorFrete = null;
    
    	$comprimento = 0;
    	$altura = 0;
    	$largura = 0;
    	$peso = 0;
    	if($request->isPost())
    	{
    	    $xml = new Xml();
    		    $postData = $request->getPost()->toArray();
                $serviceFrete = $this->getServiceLocator()->get("DrkCorreios\Service\Frete");
                $serviceFrete->setSCepDestino($postData['cep']);
                $freteCalculo = $xml->fromString($serviceFrete->calcularFrete());
    
                	if($freteCalculo['cServico']['Erro'] == 0)
                	{
                		$valorFrete = $valorFrete+str_replace(",", ".", $freteCalculo['cServico']['Valor']);
                	}
                	else
                	{
                		$errorVerify = true;
                	}
                	$service = $this->getServiceLocator()->get('CarrinhoCompras\Model\Carrinho');
                	$valueUpdated = str_replace("R$", "", $service->calculoTotal());
                	$valueUpdated = str_replace(".", "", $valueUpdated);
                	$valueUpdated = str_replace(",", ".", $valueUpdated);
        	        $filter = new \NumberFormatter('pt_BR', \NumberFormatter::CURRENCY);
                    	if($errorVerify)
                    	{
                    	    $dataInfo = $filter->format($valueUpdated);
                    	}
    		            else
    			        {
    				        $dataInfo = $filter->format($valorFrete+$valueUpdated);
    			        }
                			$viewModel = new ViewModel(array("data" => $dataInfo));
                			$viewModel->setTerminal(true);
                			return $viewModel;
    				}
    
       }
}

