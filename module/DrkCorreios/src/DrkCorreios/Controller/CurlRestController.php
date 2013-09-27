<?php
namespace DrkCorreios\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
class CurlRestController extends AbstractActionController
{
    public function getListAction()
    {     
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        
        $request = $this->getRequest();
        $matriz = array();        
        $matriz['CEP'] = $request->getPost('cep');
        $matriz['Metodo'] = "listaLogradouro";
        $matriz['TipoConsulta'] = "cep";
        $matriz['StartRow'] = "1";
        $matriz['EndRow'] = "10";
        
        $curl = $this->getServiceLocator()->get('DrkCorreios\Service\DrkCorreios');        
        $data = $curl->requisicaoDom($matriz);
        
        return new ViewModel(array('data'=>$curl->requisicaoDom($matriz)));        
    }
}