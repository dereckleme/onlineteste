<?php
namespace Pagamento\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * PagamentoControlepedido
 *
 * @ORM\Table(name="pagamento_controlepedido")
 * @ORM\Entity
 */
class PagamentoControlepedido
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPagamento_ControlePedido", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpagamentoControlepedido;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantidade", type="integer", nullable=false)
     */
    private $quantidade;

    /**
     * @var \PagamentoControlerecibo
     *
     * @ORM\ManyToOne(targetEntity="PagamentoControlerecibo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idControleRecibo", referencedColumnName="idControleRecibo")
     * })
     */
    private $idcontrolerecibo;

    /**
     * @var \ProdutoProdutos
     *
     * @ORM\ManyToOne(targetEntity="ProdutoProdutos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Produtos_idProduto", referencedColumnName="idProduto")
     * })
     */
    private $produtosproduto;
	public function getIdpagamentoControlepedido() {
		return $this->idpagamentoControlepedido;
	}

	public function getQuantidade() {
		return $this->quantidade;
	}

	public function getIdcontrolerecibo() {
		return $this->idcontrolerecibo;
	}

	public function getProdutosproduto() {
		return $this->produtosproduto;
	}

	public function setIdpagamentoControlepedido($idpagamentoControlepedido) {
		$this->idpagamentoControlepedido = $idpagamentoControlepedido;
	}

	public function setQuantidade($quantidade) {
		$this->quantidade = $quantidade;
	}

	public function setIdcontrolerecibo($idcontrolerecibo) {
		$this->idcontrolerecibo = $idcontrolerecibo;
	}

	public function setProdutosproduto($produtosproduto) {
		$this->produtosproduto = $produtosproduto;
	}


    
}
