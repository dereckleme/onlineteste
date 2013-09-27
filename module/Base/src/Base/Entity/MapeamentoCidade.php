<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MapeamentoCidade
 *
 * @ORM\Table(name="mapeamento_cidade")
 * @ORM\Entity
 */
class MapeamentoCidade
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcidade", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcidade;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeclatura", type="string", length=255, nullable=true)
     */
    private $nomeclatura;

    /**
     * @var \Usuario\Entity\MapeamentoEstado
     *
     * @ORM\ManyToOne(targetEntity="Usuario\Entity\MapeamentoEstado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mapeamento_idestado", referencedColumnName="idmapeamento_estado")
     * })
     */
    private $mapeamentoestado;


}
