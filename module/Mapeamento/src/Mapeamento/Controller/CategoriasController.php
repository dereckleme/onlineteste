<?php

namespace Mapeamento\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoriasController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }
    public function retornaProdutosByCategoriaAction()
    {
        return new ViewModel();
    }
    public function retornaProdutosByCategoriaAndSubcategoriaAction()
    {
    	return new ViewModel();
    }
}

