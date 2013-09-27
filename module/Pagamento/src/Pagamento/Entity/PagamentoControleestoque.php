<?php
namespace Pagamento\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * PagamentoControleestoque
 *
 * @ORM\Table(name="pagamento_controleestoque")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Pagamento\Entity\PagamentoControleestoqueRepository")
 */
class PagamentoControleestoque
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idControleEstoque", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcontroleestoque;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantidade", type="integer", nullable=true)
     */
    private $quantidade;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_atualizacao", type="datetime", nullable=true)
     */
    private $dtAtualizacao;

    /**
     * @var \ProdutoProdutos
     *
     * @ORM\ManyToOne(targetEntity="ProdutoProdutos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Produto_idProduto", referencedColumnName="idProduto")
     * })
     */
    private $produtoproduto;
    
	public function getIdcontroleestoque() {
		return $this->idcontroleestoque;
	}

	public function getQuantidade() {
		return $this->quantidade;
	}

	public function getDtAtualizacao() {
		return $this->dtAtualizacao;
	}

	public function getProdutoproduto() {
		return $this->produtoproduto;
	}

	public function setIdcontroleestoque($idcontroleestoque) {
		$this->idcontroleestoque = $idcontroleestoque;
	}

	public function setQuantidade($quantidade) {
		$this->quantidade = $quantidade;
	}

	public function setDtAtualizacao($dtAtualizacao) {
		$this->dtAtualizacao = $dtAtualizacao;
	}

	public function setProdutoproduto($produtoproduto) {
		$this->produtoproduto = $produtoproduto;
	}


    
}
