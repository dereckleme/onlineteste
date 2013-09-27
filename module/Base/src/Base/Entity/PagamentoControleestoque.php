<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PagamentoControleestoque
 *
 * @ORM\Table(name="pagamento_controleestoque")
 * @ORM\Entity
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
     * @var \Usuario\Entity\ProdutoProdutos
     *
     * @ORM\ManyToOne(targetEntity="Usuario\Entity\ProdutoProdutos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Produto_idProduto", referencedColumnName="idProduto")
     * })
     */
    private $produtoproduto;


}
