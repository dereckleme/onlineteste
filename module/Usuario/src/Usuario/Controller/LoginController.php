<?php

namespace Usuario\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

class LoginController extends AbstractActionController
{

    public function indexAction()
    {       
        $request = $this->getRequest();
        
        if($request->isPost())
        {
                $data = $request->getPost()->toArray();
                // Criando Storage para gravar sessão da authtenticação
                $sessionStorage = new SessionStorage("Usuario");
                
                $auth = new AuthenticationService;
                $auth->setStorage($sessionStorage); // Definindo o SessionStorage para a auth
                
                $authAdapter = $this->getServiceLocator()->get("Usuario\Auth\Adapter");
                $authAdapter->setUsername($data['eventLogin']);
                $authAdapter->setPassword(md5($data['eventPassword']));
                
                $result = $auth->authenticate($authAdapter);
                if($result->isValid())
                {
                    $sessionStorage->write($auth->getIdentity()['usuario'],null);
                    $viewModel = new ViewModel(array('message' => "01"));
                }
                else
                {
                    $viewModel = new ViewModel(array('message' => "Usuário ou senha inválido."));
                }
        }
        else
        {
            $viewModel = new ViewModel(array('message' => "Usuário ou senha inválido."));
        }
        $viewModel->setTerminal(true);
        return $viewModel;
    }
    public function logoutAction()
    {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage("Usuario"));
        $auth->clearIdentity();
        
        return $this->redirect()->toRoute('home');
    }
}
