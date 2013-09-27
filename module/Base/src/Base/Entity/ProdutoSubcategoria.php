<?php

namespace Base\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * ProdutoSubcategoria
 *
 * @ORM\Table(name="produto_subcategoria")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Produto\Entity\ProdutoSubcategoriaRepository")
 */
class ProdutoSubcategoria
{
    public function __construct() {
    	$this->produtos = new ArrayCollection();
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="idSubcategoria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsubcategoria;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @var string
     * @Gedmo\Slug(fields={"nome"}, unique=true)
     * @ORM\Column(name="slug_subcategoria", type="string", length=255, nullable=true)
     */
    private $slugSubcategoria;

    /**
     * @var \Produto\Entity\ProdutoCategorias
     *
     * @ORM\ManyToOne(targetEntity="Produto\Entity\ProdutoCategorias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Produto_idCategorias", referencedColumnName="idCategorias")
     * })
     */
    private $categorias;    
    
    /**
     * @ORM\OneToMany(targetEntity="Produto\Entity\ProdutoProdutos", mappedBy="produtosubcategoria")
     */
    protected $produtos;
    
    
    
	public function getIdsubcategoria() {
		return $this->idsubcategoria;
	}

	public function getNome() {
		return $this->nome;
	}

	public function getCategorias() {
		return $this->categorias;
	}

	public function setIdsubcategoria($idsubcategoria) {
		$this->idsubcategoria = $idsubcategoria;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function setCategorias($categorias) {
		$this->categorias = $categorias;
	}
	
	/**
	 * @return the $produtos
	 */
	public function getProdutos() {
		return $this->produtos;
	}
	
	/**
	 * @return the $slugSubcategoria
	 */
	public function getSlugSubcategoria() {
		return $this->slugSubcategoria;
	}


    

    
}
