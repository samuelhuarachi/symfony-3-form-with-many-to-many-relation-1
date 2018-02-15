<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="assinatura_categoria")
 */
class AssinaturaCategoria
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Genus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $genus;

    /**
     * @ORM\ManyToOne(targetEntity="Assinatura", inversedBy="assinaturaCategorias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $assinatura;


    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="categoriaAssinaturas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria;



    public function getId()
    {
        return $this->id;
    }


    public function getAssinatura()
    {
        return $this->assinatura;
    }

    public function setAssinatura($assinatura): void
    {
        $this->assinatura = $assinatura;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria): void
    {
        $this->categoria = $categoria;
    }

    public function getGenus()
    {
        return $this->genus;
    }

    public function setGenus($genus): void
    {
        $this->genus = $genus;
    }

}