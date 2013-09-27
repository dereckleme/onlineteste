<?php
namespace Pagamento\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Base\Service\AbstractService;

class Estoque extends AbstractService{
    protected $idProduto;
    public function __construct(EntityManager $em){
    	parent::__construct($em);
    }
    public function insert(array $data)
    {
        $this->entity = "Produto\Entity\PagamentoControleestoque";
        $this->setTargetEntity("Produto\Entity\ProdutoProdutos");
	    $this->setCampo("setProdutoproduto");
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