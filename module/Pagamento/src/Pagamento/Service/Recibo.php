<?php 
namespace Pagamento\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Base\Service\AbstractService;

class Recibo extends AbstractService{
    public function __construct(EntityManager $em){
    	parent::__construct($em);
    	$this->entity = "Pagamento\Entity\PagamentoControlerecibo";
    }
    public function insert(array $data)
    {
    	$this->setTargetEntity(array(
    			array("setTargetEntity" => "Pagamento\Entity\UsuarioUsuarios",
    					"setCampo" => "setUsuariousuarios",
    					"setActionReference" => $data['idUsuario']),
    	));
    	$data = parent::insert($data);
    	return $data;
    }
    public function update(array $data)
    {
    	$this->setTargetEntity(array(
    			array("setTargetEntity" => "Pagamento\Entity\PagamentoStatusFpagamento",
    					"setCampo" => "setFpagamento",
    					"setActionReference" => $data['SetfPagamento']),
    			array("setTargetEntity" => "Pagamento\Entity\PagamentoStatusSpagamento",
    					"setCampo" => "setSpagamento",
    					"setActionReference" => $data['Setspagamento']),
    	));
    	if($data['Setspagamento'] == 3) $data['status'] = 1;
    	parent::update($data);
    }
}
?>