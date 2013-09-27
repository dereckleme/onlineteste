<?php
namespace Pagseguro\Service;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Base\Service\AbstractService;


class Pagseguro extends AbstractService
{
    public function __construct(EntityManager $em){
    	parent::__construct($em);
    	$this->entity = "Pagamento\Entity\PagamentoControlerecibo";
    }
    public function update(array $data,$token = false)
    {
       if(!$token)
       {
    	$this->setTargetEntity(array(
    			array("setTargetEntity" => "Pagamento\Entity\PagamentoStatusFpagamento",
    					"setCampo" => "setFpagamento",
    					"setActionReference" => $data['SetfPagamento']),
    			array("setTargetEntity" => "Pagamento\Entity\PagamentoStatusSpagamento",
    					"setCampo" => "setSpagamento",
    					"setActionReference" => $data['Setspagamento']),
    	));
       }
       
       if($data['Setspagamento'] == 3) $data['status'] = 1;
       parent::update($data);
    }
}

?>