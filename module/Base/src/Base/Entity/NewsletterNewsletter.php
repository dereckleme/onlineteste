<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsletterNewsletter
 *
 * @ORM\Table(name="newsletter_newsletter")
 * @ORM\Entity
 */
class NewsletterNewsletter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idnewsletter", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idnewsletter;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=true)
     */
    private $email;


}
