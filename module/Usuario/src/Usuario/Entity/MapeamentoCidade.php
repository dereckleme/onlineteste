<?php

namespace Usuario\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MapeamentoCidade
 *
 * @ORM\Table(name="mapeamento_cidade")
 * @ORM\Entity
 */
class MapeamentoCidade
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcidade", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcidade;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeclatura", type="string", length=255, nullable=true)
     */
    private $nomeclatura;

    /**
     * @var \MapeamentoEstado
     *
     * @ORM\ManyToOne(targetEntity="MapeamentoEstado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mapeamento_idestado", referencedColumnName="idmapeamento_estado")
     * })
     */
    private $mapeamentoestado;
	public function getIdcidade() {
		return $this->idcidade;
	}

	public function getNome() {
		return $this->nome;
	}

	public function getNomeclatura() {
		return $this->nomeclatura;
	}

	public function getMapeamentoestado() {
		return $this->mapeamentoestado;
	}

	public function setIdcidade($idcidade) {
		$this->idcidade = $idcidade;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}

	public function setNomeclatura($nomeclatura) {
		$this->nomeclatura = $nomeclatura;
	}

	public function setMapeamentoestado($mapeamentoestado) {
		$this->mapeamentoestado = $mapeamentoestado;
	}


    
}
