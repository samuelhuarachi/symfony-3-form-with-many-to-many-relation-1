<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="genus_categoria")
 * @UniqueEntity(
 *     fields={"genus", "categoria"},
 *     message="Essa categoria já pertence a esse GENUSSUU",
 *     errorPath="categoria"
 * )
 */
class GenusCategoria
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="Genus", inversedBy="genusCategorias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $genus;


    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="categoriaGenuses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria;


    public function getId()
    {
        return $this->id;
    }

    public function getGenus()
    {
        return $this->genus;
    }

    public function setGenus($genus): void
    {
        $this->genus = $genus;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria): void
    {
        $this->categoria = $categoria;
    }

}