<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriaRepository")
 */
class Categoria
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
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="GenusCategoria", mappedBy="categoria")
     */
    private $categoriaGenuses;


    /**
     * @ORM\OneToMany(
     *     targetEntity="AssinaturaCategoria",
     *     mappedBy="categoria",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     * @Assert\Valid()
     */
    private $categoriaAssinaturas;


    public function __construct()
    {
        $this->categoriaGenuses = new ArrayCollection();
        $this->categoriaAssinaturas = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|AssinaturaCategoria[]
     */
    public function getCategoriaAssinaturas()
    {
        return $this->categoriaAssinaturas;
    }

    /**
     * @return ArrayCollection|GenusCategoria[]
     */
    public function getCategoriaGenuses()
    {
        return $this->categoriaGenuses;
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
     * @return Categoria
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
