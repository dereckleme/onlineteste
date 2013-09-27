<?php
namespace Produto\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Base\Service\AbstractService;

class ProdutoImagens extends AbstractService
{
    protected $idProduto;
    
    public function __construct(EntityManager $em){
    	parent::__construct($em);    
    }
    
    public function insert(array $data){
        $this->entity = "Produto\Entity\ProdutoImagens";
        $this->setTargetEntity("Produto\Entity\ProdutoProdutos");
        $this->setCampo("setProdutoProdutosproduto");
        $this->setActionReference($this->idProduto);
        return parent::insert($data);
    }
    
    /**
     * @param field_type $idProduto
     */
    public function setIdProduto($idProduto) {
    	$this->idProduto = $idProduto;
    }
    
}