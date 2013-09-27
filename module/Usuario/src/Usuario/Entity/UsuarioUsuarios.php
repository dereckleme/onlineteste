<?php

namespace Usuario\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioUsuarios
 *
 * @ORM\Table(name="usuario_usuarios")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Usuario\Entity\UsuarioUsuariosRepository")
 */
class UsuarioUsuarios
{
    public function __construct()
    {
    	$this->nivel = 2;
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="idUsuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idusuario;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255, nullable=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=255, nullable=true)
     */
    private $senha;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="nivel", type="integer", nullable=false)
     */
    private $nivelUsuario;
	public function getIdusuario() {
		return $this->idusuario;
	}

	public function getLogin() {
		return $this->login;
	}

	public function getSenha() {
		return $this->senha;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getNivelUsuario() {
		return $this->nivelUsuario;
	}

	public function setIdusuario($idusuario) {
		$this->idusuario = $idusuario;
	}

	public function setLogin($login) {
		$this->login = $login;
	}

	public function setSenha($senha) {
		$this->senha = $senha;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function setNivelUsuario($nivelUsuario) {
		$this->nivelUsuario = $nivelUsuario;
	}

    
    
}
