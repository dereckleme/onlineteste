<?php

namespace Usuario\Service;

use Doctrine\ORM\EntityManager;
use Base\Service\AbstractService;
class Usuario extends AbstractService{
	
	public function __construct(EntityManager $em)
	{
		parent::__construct($em);
        $this->entity = "Usuario\Entity\UsuarioUsuarios";
	}
	
}

?>