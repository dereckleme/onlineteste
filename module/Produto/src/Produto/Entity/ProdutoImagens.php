<?php

namespace Produto\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoImagens
 *
 * @ORM\Table(name="produto_imagens")
 * @ORM\Entity
 */
class ProdutoImagens
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idProduto_Imagens", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprodutoImagens;

    /**
     * @var string
     *
     * @ORM\Column(name="images", type="string", length=255, nullable=true)
     */
    private $images;

    /**
     * @var \Produto\Entity\ProdutoProdutos
     *
     * @ORM\ManyToOne(targetEntity="Produto\Entity\ProdutoProdutos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Produto_Produtos_idProduto", referencedColumnName="idProduto")
     * })
     */
    private $produtoProdutosproduto;
    
	/**
	 * @return the $idprodutoImagens
	 */
	public function getIdprodutoImagens() {
		return $this->idprodutoImagens;
	}

	/**
	 * @return the $produtoProdutosproduto
	 */
	public function getProdutoProdutosproduto() {
		return $this->produtoProdutosproduto;
	}
	
	/**
	 * @return the $images
	 */
	public function getImages() {
		return $this->images;
	}

	/**
	 * @param string $images
	 */
	public function setImages($images) {
		$this->images = $images;
	}

	/**
	 * @param number $idprodutoImagens
	 */
	public function setIdprodutoImagens($idprodutoImagens) {
		$this->idprodutoImagens = $idprodutoImagens;
	}

	/**
	 * @param \Produto\Entity\ProdutoProdutos $produtoProdutosproduto
	 */
	public function setProdutoProdutosproduto($produtoProdutosproduto) {
		$this->produtoProdutosproduto = $produtoProdutosproduto;
	}



}