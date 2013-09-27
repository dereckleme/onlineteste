<?php

namespace Usuario\Service;

use Doctrine\ORM\EntityManager;
use Base\Service\AbstractService;
class Cadastro extends AbstractService{
	
	public function __construct(EntityManager $em)
	{
		parent::__construct($em);
        $this->entity = "Usuario\Entity\UsuarioCadastro";
	}
	public function insert($idUsuario)
	{
	    $this->setTargetEntity(array(
	    		array("setTargetEntity" => "Usuario\Entity\UsuarioUsuarios",
	    				"setCampo" => "setUsuariosusuarios",
	    				"setActionReference" => $idUsuario)
	    ));
	     parent::insert(array());
	}
	public function update(array $data)
	{
	    if(!empty($data['cidade']))
	    {
	        $this->setTargetEntity(array(
	        		array("setTargetEntity" => "Usuario\Entity\MapeamentoCidade",
	        				"setCampo" => "setMapeamentocidade",
	        				"setActionReference" => $data['cidade'])
	        ));
	        parent::update($data);
	    }
	    else
	    {
	        parent::update($data);
	    }
	}
}

?>