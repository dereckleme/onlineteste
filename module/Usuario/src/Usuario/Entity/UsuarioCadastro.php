<?php

namespace Usuario\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioCadastro
 *
 * @ORM\Table(name="usuario_cadastro")
 * @ORM\Entity
 */
class UsuarioCadastro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcadastro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcadastro;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="cep", type="string", length=255, nullable=true)
     */
    private $cep;
    /**
     * @var string
     *
     * @ORM\Column(name="bairro", type="string", length=255, nullable=true)
     */
    private $bairro;
    /**
     * @var string
     *
     * @ORM\Column(name="rua", type="string", length=255, nullable=true)
     */
    private $rua;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=45, nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", length=45, nullable=true)
     */
    private $cpf;

    /**
     * @var string
     *
     * @ORM\Column(name="cnpj", type="string", length=45, nullable=true)
     */
    private $cnpj;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone_res", type="string", length=255, nullable=true)
     */
    private $telefoneRes;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone_cel", type="string", length=255, nullable=true)
     */
    private $telefoneCel;

    /**
     * @var \MapeamentoCidade
     *
     * @ORM\ManyToOne(targetEntity="MapeamentoCidade")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mapeamento_idcidade", referencedColumnName="idcidade")
     * })
     */
    private $mapeamentocidade;

    /**
     * @var \UsuarioUsuarios
     *
     * @ORM\ManyToOne(targetEntity="UsuarioUsuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Usuarios_idUsuarios", referencedColumnName="idUsuario")
     * })
     */
    private $usuariosusuarios;
    
	public function getIdcadastro() {
		return $this->idcadastro;
	}

	public function getNome() {
		return $this->nome;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getRua() {
		return $this->rua;
	}

	public function getNumero() {
		return $this->numero;
	}

	public function getCpf() {
		return $this->cpf;
	}

	public function getCnpj() {
		return $this->cnpj;
	}

	public function getTelefoneRes() {
		return $this->telefoneRes;
	}

	public function getTelefoneCel() {
		return $this->telefoneCel;
	}

	public function getMapeamentocidade() {
		return $this->mapeamentocidade;
	}

	public function getUsuariosusuarios() {
		return $this->usuariosusuarios;
	}

	public function setIdcadastro($idcadastro) {
		$this->idcadastro = $idcadastro;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function setRua($rua) {
		$this->rua = $rua;
	}

	public function setNumero($numero) {
		$this->numero = $numero;
	}

	public function setCpf($cpf) {
		$this->cpf = $cpf;
	}

	public function setCnpj($cnpj) {
		$this->cnpj = $cnpj;
	}

	public function setTelefoneRes($telefoneRes) {
		$this->telefoneRes = $telefoneRes;
	}

	public function setTelefoneCel($telefoneCel) {
		$this->telefoneCel = $telefoneCel;
	}

	public function setMapeamentocidade($mapeamentocidade) {
		$this->mapeamentocidade = $mapeamentocidade;
	}

	public function setUsuariosusuarios($usuariosusuarios) {
		$this->usuariosusuarios = $usuariosusuarios;
	}
	
	public function getCep() {
		return $this->cep;
	}

	public function setCep($cep) {
		$this->cep = $cep;
	}
	public function getBairro() {
		return $this->bairro;
	}

	public function setBairro($bairro) {
		$this->bairro = $bairro;
	}



    
    
}
