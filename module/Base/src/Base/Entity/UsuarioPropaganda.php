<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuarioPropaganda
 *
 * @ORM\Table(name="usuario_propaganda")
 * @ORM\Entity
 */
class UsuarioPropaganda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpropaganda", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpropaganda;

    /**
     * @var \Usuario\Entity\UsuarioCadastro
     *
     * @ORM\ManyToOne(targetEntity="Usuario\Entity\UsuarioCadastro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_idcadastro", referencedColumnName="idcadastro")
     * })
     */
    private $usuariocadastro;


}
