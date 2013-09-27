<?php
namespace Produto\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoReferencia
 *
 * @ORM\Table(name="produto_referencia")
 * @ORM\Entity
 */
class ProdutoReferencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idReferencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreferencia;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_referencia", type="string", length=255, nullable=true)
     */
    private $nomeReferencia;
    
	public function getIdreferencia() {
		return $this->idreferencia;
	}

	public function getNomeReferencia() {
		return $this->nomeReferencia;
	}

	public function setIdreferencia($idreferencia) {
		$this->idreferencia = $idreferencia;
	}

	public function setNomeReferencia($nomeReferencia) {
		$this->nomeReferencia = $nomeReferencia;
	}


    
}
