<?php

namespace Produto\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoReferenciasetter
 *
 * @ORM\Table(name="produto_referenciasetter")
 * @ORM\Entity
 */
class ProdutoReferenciasetter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idPReferenciaSetter", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpreferenciasetter;

    /**
     * @var \ProdutoReferencia
     *
     * @ORM\ManyToOne(targetEntity="ProdutoReferencia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idReferencia", referencedColumnName="idReferencia")
     * })
     */
    private $idreferencia;

    /**
     * @var \ProdutoCategorias
     *
     * @ORM\ManyToOne(targetEntity="ProdutoCategorias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategorias", referencedColumnName="idCategorias")
     * })
     */
    private $idcategorias;


}
