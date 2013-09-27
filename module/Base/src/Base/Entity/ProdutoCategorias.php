<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoCategorias
 *
 * @ORM\Table(name="produto_categorias")
 * @ORM\Entity
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
     *
     * @ORM\Column(name="slug_categoria", type="string", length=255, nullable=true)
     */
    private $slugCategoria;


}
