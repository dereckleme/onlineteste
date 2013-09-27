<?php
namespace Pagamento\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Base\Service\AbstractService;

class Pedido extends AbstractService{
    public function __construct(EntityManager $em){
    	parent::__construct($em);
    	$this->entity = "Pagamento\Entity\PagamentoControlepedido";
    }
    public function insert(array $data)
    {
        $this->setTargetEntity(array(
	    		array("setTargetEntity" => "Pagamento\Entity\PagamentoControlerecibo",
	    				"setCampo" => "setIdcontrolerecibo",
	    				"setActionReference" => $data['idRecibo']),
            array("setTargetEntity" => "Pagamento\Entity\ProdutoProdutos",
            		"setCampo" => "setProdutosproduto",
            		"setActionReference" => $data['idProduto']),
	    ));
    	return parent::insert($data);
    }
}