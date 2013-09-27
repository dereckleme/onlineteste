<?php

namespace Produto\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoCategorias
 *
 * @ORM\Table(name="produto_categorias")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Produto\Entity\ProdutoCategoriasRepository")
 */
class ProdutoCategorias
{    
    /**
     * @var integer
     *
     * @ORM\Column(name="idCategorias", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategorias;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @var string
     * @Gedmo\Slug(fields={"nome"}, unique=true)
     * @ORM\Column(name="slug_categoria", type="string", length=255, nullable=true)
     */
    private $slug;
    
    
    /**
     * @ORM\OneToMany(targetEntity="ProdutoSubcategoria", mappedBy="categorias")
     * @var Collection
     */
    private $subcategorias;
    
    
    
	public function getSubcategorias() {
		return $this->subcategorias;
	}

	public function setSubcategorias($subcategorias) {
		$this->subcategorias = $subcategorias;
	}

	public function getIdcategorias() {
		return $this->idcategorias;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setIdcategorias($idcategorias) {
		$this->idcategorias = $idcategorias;
	}

	public function setNome($nome) {
		$this->nome = $nome;
	}
	
	/**
	 * @return the $slug
	 */
	public function getSlug() {
		return $this->slug;
	}
	

}