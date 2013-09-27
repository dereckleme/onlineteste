<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PagamentoControlerecibo
 *
 * @ORM\Table(name="pagamento_controlerecibo")
 * @ORM\Entity
 */
class PagamentoControlerecibo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idControleRecibo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcontrolerecibo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_venda", type="datetime", nullable=true)
     */
    private $dtVenda;

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
     * @var \Usuario\Entity\ProdutoProdutos
     *
     * @ORM\ManyToOne(targetEntity="Usuario\Entity\ProdutoProdutos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Produto_idProduto", referencedColumnName="idProduto")
     * })
     */
    private $produtoproduto;

    /**
     * @var \Usuario\Entity\UsuarioUsuarios
     *
     * @ORM\ManyToOne(targetEntity="Usuario\Entity\UsuarioUsuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Usuario_idUsuarios", referencedColumnName="idUsuario")
     * })
     */
    private $usuariousuarios;


}
