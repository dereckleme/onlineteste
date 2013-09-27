<?php

namespace Produto\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoProdutos
 *
 * @ORM\Table(name="produto_produtos")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Produto\Entity\ProdutoProdutosRepository")
 */
class ProdutoProdutos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idProduto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproduto;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     * @Gedmo\Slug(fields={"titulo"}, unique=true)
     * @ORM\Column(name="slug_produto", type="string", length=255, nullable=true)
     */
    private $slugProduto;

    /**
     * @var float
     *
     * @ORM\Column(name="valor", type="decimal", nullable=true)
     */
    private $valor;

    /**
     * @var \Usuario\Entity\ProdutoSubcategoria
     *
     * @ORM\ManyToOne(targetEntity="Produto\Entity\ProdutoSubcategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Produto_idSubcategoria", referencedColumnName="idSubcategoria")
     * })
     */
    private $produtosubcategoria;
    
	public function getIdproduto() {
		return $this->idproduto;
	}

	public function getTitulo() {
		return $this->titulo;
	}

	public function getValor() {
		return $this->valor;
	}

	public function getProdutosubcategoria() {
		return $this->produtosubcategoria;
	}

	public function setIdproduto($idproduto) {
		$this->idproduto = $idproduto;
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}

	public function setValor($valor) {
		$this->valor = $valor;
	}

	public function setProdutosubcategoria($produtosubcategoria) {
		$this->produtosubcategoria = $produtosubcategoria;
	}


    
}
