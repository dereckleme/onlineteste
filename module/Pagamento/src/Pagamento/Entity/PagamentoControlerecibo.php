<?php

namespace Pagamento\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * PagamentoControlerecibo
 *
 * @ORM\Table(name="pagamento_controlerecibo")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Pagamento\Entity\PagamentoControlereciboRepository")
 */
class PagamentoControlerecibo
{
    public function __construct() {
       $this->dtVenda = new \DateTime("now");
       $this->produtosRecibo = new ArrayCollection();
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="idControleRecibo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcontrolerecibo;

    /**
     * @var string
     *
     * @ORM\Column(name="nPedido", type="string", length=255, nullable=false)
     */
    private $npedido;
    /**
     * @var float
     *
     * @ORM\Column(name="valor_frete", type="decimal", nullable=true)
     */
    private $valorFrete;
    /**
     * @var float
     *
     * @ORM\Column(name="valor", type="decimal", nullable=true)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var \Pagamento\Entity\PagamentoStatusSpagamento
     *
     * @ORM\ManyToOne(targetEntity="Pagamento\Entity\PagamentoStatusSpagamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sPagamento", referencedColumnName="idStatus")
     * })
     */
    private $spagamento;

    /**
     * @var \Pagamento\Entity\UsuarioUsuarios
     *
     * @ORM\ManyToOne(targetEntity="Pagamento\Entity\UsuarioUsuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Usuario_idUsuarios", referencedColumnName="idUsuario")
     * })
     */
    private $usuariousuarios;

    /**
     * @var \Pagamento\Entity\PagamentoStatusFpagamento
     *
     * @ORM\ManyToOne(targetEntity="Pagamento\Entity\PagamentoStatusFpagamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fPagamento", referencedColumnName="idStatus")
     * })
     */
    private $fpagamento;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_venda", type="datetime", nullable=false)
     */
    private $dtVenda;
    
    /**
     * @ORM\OneToMany(targetEntity="Pagamento\Entity\PagamentoControlepedido", mappedBy="idcontrolerecibo")
     */
    private $produtosRecibo;
    
   
    
	public function getValorFrete() {
		return $this->valorFrete;
	}

	public function setValorFrete($valorFrete) {
		$this->valorFrete = $valorFrete;
	}

	public function getProdutosRecibo() {
		return $this->produtosRecibo;
	}

	public function setProdutosRecibo($produtosRecibo) {
		$this->produtosRecibo = $produtosRecibo;
	}

	public function getIdcontrolerecibo() {
		return $this->idcontrolerecibo;
	}

	public function getNpedido() {
		return $this->npedido;
	}

	public function getDtVenda() {
		return $this->dtVenda;
	}

	public function getValor() {
		return $this->valor;
	}

	public function getStatus() {
		return $this->status;
	}

	public function getSpagamento() {
		return $this->spagamento;
	}

	public function getUsuariousuarios() {
		return $this->usuariousuarios;
	}

	public function getFpagamento() {
		return $this->fpagamento;
	}

	public function setIdcontrolerecibo($idcontrolerecibo) {
		$this->idcontrolerecibo = $idcontrolerecibo;
	}

	public function setNpedido($npedido) {
		$this->npedido = $npedido;
	}

	public function setDtVenda($dtVenda) {
	    $this->dtVenda = new \DateTime("now");
	}

	public function setValor($valor) {
		$this->valor = $valor;
	}

	public function setStatus($status) {
		$this->status = $status;
	}

	public function setSpagamento($spagamento) {
		$this->spagamento = $spagamento;
	}

	public function setUsuariousuarios($usuariousuarios) {
		$this->usuariousuarios = $usuariousuarios;
	}

	public function setFpagamento($fpagamento) {
		$this->fpagamento = $fpagamento;
	}



}
