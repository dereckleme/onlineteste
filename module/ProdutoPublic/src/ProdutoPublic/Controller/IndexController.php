<?php

namespace ProdutoPublic\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        
        $buscaCategoria = $this->params()->fromRoute('slug',0);
        $buscaSubCategoria = $this->params()->fromRoute('slugSub',0);
        
        echo "Categoria: $buscaCategoria <br/> SubCategoria: $buscaSubCategoria";
        die();
        
        
        return new ViewModel();
    }


}

