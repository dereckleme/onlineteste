<?php

namespace Usuario\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\Persistence\ObjectManager;

use Base\Entity\UsuarioUsuarios AS usuario;

class LoadUsuario extends AbstractFixture{
	public function load(ObjectManager $manager) {
		$usuario = new usuario;
			$usuario->setLogin("dereckleme");
			$usuario->setSenha(md5("159753"));
			
			$manager->persist($usuario);
			$manager->flush();
	}
}

?>