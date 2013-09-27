<?php

namespace Pagamento\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class EstoqueController extends AbstractActionController
{

    public function indexAction()
    {
        $service = $this->getServiceLocator()->get('Pagamento\Service\Estoque');
        
        $data = array();
        $data['produtoproduto'] = '1';
        $data['quantidade'] = '50';
        
        $txt = $service->insert($data);
        
        die();        
        
        return new ViewModel();
    }
    
}

