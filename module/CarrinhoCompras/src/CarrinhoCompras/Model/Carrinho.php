<?php
namespace CarrinhoCompras\Model;
use Zend\Session\Container;
class Carrinho
{
    protected $container;
    protected $repositoryProduto;
    public function __construct(Container $container,$repositoryProduto)
    {
    	$this->container = $container;
    	$this->repositoryProduto = $repositoryProduto;
    }
    public function lista()
    {
       
        $configSessionProdutos = null;
      if(!empty($this->container->carrinho))  
      {
        foreach($this->container->carrinho AS $iten)
        {
        	$selectedItens[] = $iten['idProduto'];
        }
        $list = $this->repositoryProduto->findByidproduto($selectedItens);
            foreach($list AS $produto)
            {
                $idProduto = $produto->getIdproduto();
                if($produto->getEstoque()[0]->getQuantidade() < $this->container->carrinho[$idProduto]['quantProd'])
                {
                	$this->container->carrinho[$idProduto]['quantProd'] = $produto->getEstoque()[0]->getQuantidade();
                }
                if($produto->getEstoque()[0]->getQuantidade() == 0) 
                {
                    unset($this->container->carrinho[$idProduto]);
                }
                else {
            	$configSessionProdutos[] = array(
            	    "produto" => $produto,
            	    "quantidade" => $this->container->carrinho[$idProduto]['quantProd']
            	);
                    }
            }
      }
    #	return $this->container->carrinho;
        return $configSessionProdutos;
    }
    
    public function calculoTotal()
    {
        $filter = new \NumberFormatter('pt_BR', \NumberFormatter::CURRENCY);
        
        $total = "";
        if(!empty($this->container->carrinho))
        {
            foreach($this->container->carrinho AS $iten)
            {
            	$selectedItens[] = $iten['idProduto'];
            }
            $list = $this->repositoryProduto->findByidproduto($selectedItens);
            foreach($list AS $produto)
            {
                $idProduto = $produto->getIdproduto();
                $valorIten = $produto->getValor()*$this->container->carrinho[$idProduto]['quantProd'];
                $total = $total+$valorIten;
            }
        }    
        return $filter->format($total);
    }
}

?>