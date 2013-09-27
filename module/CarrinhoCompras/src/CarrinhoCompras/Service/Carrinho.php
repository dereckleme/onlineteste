<?php
namespace CarrinhoCompras\Service;
use Zend\Session\Container;

class Carrinho
{
    protected $idProduto;
    protected $quantProduto;
    protected $container;
    public function __construct(Container $container)
    {
        if(!isset($container->carrinho))  $container->carrinho = array();
        $this->container = $container;
    }
    public function adiciona()
    {
        if(!empty($this->idProduto) && !empty($this->quantProduto)) 
        {
            $this->container->carrinho[$this->idProduto] = array("idProduto" => $this->idProduto, "quantProd" => $this->quantProduto);
        }  
    }
    public function exclui()
    {
        if(!empty($this->idProduto))  
        { 
            unset($this->container->carrinho[$this->idProduto]);
        }   
    }
    public function limpa()
    {
        unset($this->container->carrinho);
    }
	public function setIdProduto($idProduto) {
		$this->idProduto = $idProduto;
	}
	public function setQuantProduto($quantProduto) {
		$this->quantProduto = $quantProduto;
	}
}

?>