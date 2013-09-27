<?php

namespace Pagamento\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use Zend\Config\Reader\Xml;
class FinanceiroController extends AbstractActionController
{

    public function indexAction()
    {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repoRecibo = $em->getRepository("Pagamento\Entity\PagamentoControlerecibo");
        return new ViewModel(array("recibos" => $repoRecibo->findAll()));
    }
    public function detalhePedidoAction(){
        $param = $this->params()->fromRoute("idpedido");
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repoRecibo = $em->getRepository("Pagamento\Entity\PagamentoControlerecibo");
        $recibo = $repoRecibo->findOneByidcontrolerecibo($param);
        if(count($recibo) != 0)
        {
            $cadastro = $em->getRepository("Usuario\Entity\UsuarioCadastro")->findOneByusuariosusuarios($recibo->getUsuariousuarios()->getIdusuario());
        	return new viewModel(array("data" => $recibo,"cadastro" => $cadastro));
        }
        else {
        	return $this->redirect()->toRoute('admin-financeiro');
        }
    }
    public function fecharPedidoAction()
    {
        $filter = new \NumberFormatter('pt_BR', \NumberFormatter::CURRENCY);
        $auth = new AuthenticationService;
        $xml = new Xml();
        $auth->setStorage(new SessionStorage("Usuario"));
        $service = $this->getServiceLocator()->get('CarrinhoCompras\Model\Carrinho');
         $listaProdutosCarrinho = $service->lista();
        if($auth->hasIdentity() && count($listaProdutosCarrinho) >= 1)
        {
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $entity = $em->getRepository("Usuario\Entity\UsuarioCadastro")->findOneByusuariosusuarios($auth->getIdentity()->getIdusuario());
            $serviceFrete = $this->getServiceLocator()->get("DrkCorreios\Service\Frete");
             if($entity->getCep()) 
             {    
                $serviceFrete->setSCepDestino($entity->getCep());
                $freteCalculo = $xml->fromString($serviceFrete->calcularFrete());
                if($freteCalculo['cServico']['Erro'] == 0)
                {
                    $valueUpdated = str_replace("R$", "", $service->calculoTotal());
                    $valueUpdated = str_replace(".", "", $valueUpdated);
                    $valueUpdated = str_replace(",", ".", $valueUpdated);
                    
                    $valorFrete = str_replace(",", ".", $freteCalculo['cServico']['Valor']);
                    $valorTotal = $valorFrete+$valueUpdated; //Total com frete
                    
                       if($entity->getNome() && $entity->getCep() && $entity->getRua() && $entity->getNumero() && $entity->getBairro() && $entity->getMapeamentocidade())
                       {
                           $repositoryRecibo = $em->getRepository("Pagamento\Entity\PagamentoControlerecibo");
                           $servicePagseguro = $this->getServiceLocator()->get("Pagamento\Service\Recibo");
                           $reference = $servicePagseguro->insert(array("valorFrete" => $valorFrete,"idUsuario" => $auth->getIdentity()->getIdusuario(),"npedido" => null, "valor" => $valorTotal));
                              if($reference)
                              {
                                  $servicePagseguro = $this->getServiceLocator()->get("Pagamento\Service\Pedido");
                                  foreach($listaProdutosCarrinho AS $produto)
                                  {
                                      $idProduto = $produto['produto']->getIdproduto();
                                      $servicePagseguro->insert(array("quantidade" => $produto['quantidade'],"idProduto" => $idProduto,"idRecibo" => $reference->getIdcontrolerecibo()));
                                  }
                                  $serviceCarrinho = $this->getServiceLocator()->get("CarrinhoCompras\Service\Carrinho");
                                  $servicePagseguroGerarUrl = $this->getServiceLocator()->get("Pagseguro\Curl\post");
                                  $token = $servicePagseguroGerarUrl->requisicao($reference->getIdcontrolerecibo());
                                  $service = $this->getServiceLocator()->get("Pagseguro\Service\Pagseguro");
                                  $service->update(array("id" => $reference->getIdcontrolerecibo(), "npedido" =>$token),true);
                                  $serviceCarrinho->limpa();
                                  return $this->redirect()->toUrl("https://pagseguro.uol.com.br/v2/checkout/payment.html?code=".$token);
                              }
                              else
                              {
                                  return $this->redirect()->toRoute('publico-finaliza-compra');
                              }
                       }
                       else 
                       {
                           return $this->redirect()->toRoute('publico-finaliza-compra');
                       }
                }
                else
                {
                    return $this->redirect()->toRoute('publico-finaliza-compra');
                }
             }
             else
             {
                 return $this->redirect()->toRoute('publico-finaliza-compra');
             }   
            die();
        }
        else
        {
            return $this->redirect()->toRoute('home');
        }
        
    }
}

