<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Assinatura
 *
 * @ORM\Table(name="assinatura")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AssinaturaRepository")
 */
class Assinatura
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(
     *     message="A Assinatura não pode ficar em branco"
     * )
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Genus", inversedBy="assinaturas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $genus;

    public function getGenus()
    {
        return $this->genus;
    }

    public function setGenus(Genus $genus)
    {
        $this->genus = $genus;
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Assinatura
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}
