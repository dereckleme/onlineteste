<?php

namespace Pagamento\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Zend\I18n\Filter;

/**
 * ProdutoProdutos
 *
 * @ORM\Table(name="produto_produtos")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Pagamento\Entity\ProdutoProdutosRepository")
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
     * @var integer
     *
     * @ORM\Column(name="peso", type="decimal", nullable=false)
     */
    private $peso;
    /**
     * @var integer
     *
     * @ORM\Column(name="comprimento", type="integer", nullable=false)
     */
    private $comprimento;
    /**
     * @var integer
     *
     * @ORM\Column(name="altura", type="integer", nullable=false)
     */
    private $altura;
    /**
     * @var integer
     *
     * @ORM\Column(name="largura", type="integer", nullable=false)
     */
    private $largura;
    /**
     * @var integer
     *
     * @ORM\Column(name="Destaque", type="integer", nullable=false)
     */
    private $destaque;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="acessos", type="integer", nullable=true)
     */
    private $acessos;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="ativo", type="boolean", nullable=false)
     */
    private $ativo;

    /**
     * @var \Usuario\Entity\ProdutoSubcategoria
     *
     * @ORM\ManyToOne(targetEntity="Produto\Entity\ProdutoSubcategoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Produto_idSubcategoria", referencedColumnName="idSubcategoria")
     * })
     */
    private $produtosubcategoria;
    
    
    
	/**
	 * @return the $slugProduto
	 */
	public function getSlugProduto() {
		return $this->slugProduto;
	}

	public function getIdproduto() {
		return $this->idproduto;
	}

	public function getTitulo() {
		return $this->titulo;
	}

	public function getValor($formatado = false) {
	    if($formatado)
	    {
	        $filter = new \NumberFormatter('pt_BR', \NumberFormatter::CURRENCY);
	        return $filter->formatCurrency($this->valor, 'BRL');
	    }
	    else
	    {
	        return $this->valor;
	    }	    	   
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

	public function setValor($valor, $formatar=true) {
	    $valor = str_replace(".", "", $valor);
	    $valor = str_replace(",", ".", $valor);
		$this->valor = $valor;
	}

	public function setProdutosubcategoria($produtosubcategoria) {
		$this->produtosubcategoria = $produtosubcategoria;
	}
	
	/**
	 * @return the $destaque
	 */
	public function getDestaque() {
		return $this->destaque;
	}

	/**
	 * @param number $destaque
	 */
	public function setDestaque($destaque) {
		$this->destaque = $destaque;
	}

	/**
	 * @return the $ativo
	 */
	public function getAtivo() {
		return $this->ativo;
	}

	/**
	 * @param boolean $ativo
	 */
	public function setAtivo($ativo) {
		$this->ativo = $ativo;
	}

	public function getPeso() {
		return $this->peso;
	}

	public function getComprimento() {
		return $this->comprimento;
	}

	public function getAltura() {
		return $this->altura;
	}

	public function getLargura() {
		return $this->largura;
	}

	public function setPeso($peso) {
		$this->peso = $peso;
	}

	public function setComprimento($comprimento) {
		$this->comprimento = $comprimento;
	}

	public function setAltura($altura) {
		$this->altura = $altura;
	}

	public function setLargura($largura) {
		$this->largura = $largura;
	}
	
	/**
	 * @return the $acessos
	 */
	public function getAcessos() {
		return $this->acessos;
	}

	/**
	 * @param number $acessos
	 */
	public function setAcessos($acessos) {
		$this->acessos = $acessos;
	}

    

    
}
