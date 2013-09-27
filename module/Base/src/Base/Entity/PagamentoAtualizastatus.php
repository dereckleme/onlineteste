<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PagamentoAtualizastatus
 *
 * @ORM\Table(name="pagamento_atualizastatus")
 * @ORM\Entity
 */
class PagamentoAtualizastatus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idatualizaStatus", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idatualizastatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_update", type="datetime", nullable=true)
     */
    private $dtUpdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status;

    /**
     * @var \Usuario\Entity\PagamentoControlerecibo
     *
     * @ORM\ManyToOne(targetEntity="Usuario\Entity\PagamentoControlerecibo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Pagamento_idControleRecibo", referencedColumnName="idControleRecibo")
     * })
     */
    private $pagamentocontrolerecibo;


}
