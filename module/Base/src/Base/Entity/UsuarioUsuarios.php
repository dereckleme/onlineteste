<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioUsuarios
 *
 * @ORM\Table(name="usuario_usuarios")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Base\Entity\UsuarioUsuariosRepository")
 */
class UsuarioUsuarios
{
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
     * @var \DateTime
     *
     * @ORM\Column(name="dt_cadastro", type="datetime", nullable=true)
     */
    private $dtCadastro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_ativacao", type="datetime", nullable=true)
     */
    private $dtAtivacao;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="nivel", type="integer", nullable=false)
     */
    private $nivelUsuario;
    
	public function getNivelUsuario() {
		return $this->nivelUsuario;
	}

	public function setNivelUsuario($nivelUsuario) {
		$this->nivelUsuario = $nivelUsuario;
	}

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

	public function getDtCadastro() {
		return $this->dtCadastro;
	}

	public function getDtAtivacao() {
		return $this->dtAtivacao;
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

	public function setDtCadastro($dtCadastro) {
		$this->dtCadastro = $dtCadastro;
	}

	public function setDtAtivacao($dtAtivacao) {
		$this->dtAtivacao = $dtAtivacao;
	}


	
}
