<?php

/**
 * dereck
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class MapeamentoController extends AbstractActionController
{    
    
    public function indexAction()
    {
        $params = $this->params()->fromRoute('nomeclatura');
         $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
         $cidades = $em->getRepository("Usuario\Entity\MapeamentoCidade")->findBy(array("nomeclatura" => $params));
        $viewModel = new ViewModel(array("cidades" => $cidades));
        $viewModel->setTerminal(true);
        return $viewModel;
    }
}
