<?php

namespace AppBundle\Entity;

use AppBundle\Repository\GenusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenusRepository")
 * @ORM\Table(name="genus")
 */
class Genus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SubFamily")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subFamily;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(min=0, minMessage="Negative species! Come on...")
     * @ORM\Column(type="integer")
     */
    private $speciesCount;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $funFact;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished = true;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="date")
     */
    private $firstDiscoveredAt;

    /**
     * @ORM\OneToMany(
     *     targetEntity="GenusScientist",
     *     mappedBy="genus",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     * @Assert\Valid()
     */
    private $genusScientists;

    /**
     * @ORM\OneToMany(
     *     targetEntity="GenusCategoria",
     *     mappedBy="genus",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     * @Assert\Valid()
     */
    private $genusCategorias;


    /**
     * @ORM\OneToMany(
     *     targetEntity="Assinatura",
     *     mappedBy="genus"
     * )
     * @Assert\Valid()
     */
    private $assinaturas;


    /**
     * @ORM\Column(type="string", unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="GenusNote", mappedBy="genus")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->genusScientists = new ArrayCollection();
        $this->genusCategorias = new ArrayCollection();
        $this->assinaturas = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|Assinaturas[]
     */
    public function getAssinaturas()
    {
        return $this->assinaturas;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return SubFamily
     */
    public function getSubFamily()
    {
        return $this->subFamily;
    }

    public function setSubFamily(SubFamily $subFamily = null)
    {
        $this->subFamily = $subFamily;
    }

    public function getSpeciesCount()
    {
        return $this->speciesCount;
    }

    public function setSpeciesCount($speciesCount)
    {
        $this->speciesCount = $speciesCount;
    }

    public function getFunFact()
    {
        return $this->funFact;
    }

    public function setFunFact($funFact)
    {
        $this->funFact = $funFact;
    }

    public function getUpdatedAt()
    {
        return new \DateTime('-'.rand(0, 100).' days');
    }

    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
    }

    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @return ArrayCollection|GenusNote[]
     */
    public function getNotes()
    {
        return $this->notes;
    }

    public function getFirstDiscoveredAt()
    {
        return $this->firstDiscoveredAt;
    }

    public function setFirstDiscoveredAt(\DateTime $firstDiscoveredAt = null)
    {
        $this->firstDiscoveredAt = $firstDiscoveredAt;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    public function addGenusScientist(GenusScientist $genusScientist)
    {
        if ($this->genusScientists->contains($genusScientist)) {
            return;
        }
        $this->genusScientists[] = $genusScientist;
        // needed  to update the owing side of the relationship!
        $genusScientist->setGenus($this);
    }

    /**
     * @return ArrayCollection|GenusScientist[]
     */
    public function getGenusScientists()
    {
        return $this->genusScientists;
    }

    public function removeGenusScientist(GenusScientist $genusScientist)
    {
        if (!$this->genusScientists->contains($genusScientist)) {
            return;
        }

        $this->genusScientists->removeElement($genusScientist);
        // needed  to update the owing side of the relationship!
        $genusScientist->setGenus(null);
    }

    public function getExpertScientists()
    {
//        return $this->getGenusScientists()->filter(function(GenusScientist $genusScientist) {
//            return $genusScientist->getYearsStudied() > 20;
//        });



        return $this->getGenusScientists()->matching(
            GenusRepository::createExpertCriteria()
        );
    }

    // >>>>>>>>>>>>.. Categoria <<<<<<<<<<<<<<<<<<

    public function addGenusCategoria(GenusCategoria $genusCategoria)
    {
        if ($this->genusCategorias->contains($genusCategoria)) {
            return;
        }
        $this->genusCategorias[] = $genusCategoria;
        // needed  to update the owing side of the relationship!
        $genusCategoria->setGenus($this);
    }

    public function removeGenusCategoria(GenusCategoria $genusCategoria)
    {
        if (!$this->genusCategorias->contains($genusCategoria)) {
            return;
        }
        $this->genusCategorias->removeElement($genusCategoria);

        // needed  to update the owing side of the relationship!
        $genusCategoria->setGenus(null);
    }

    /**
     * @return ArrayCollection|GenusCategoria[]
     */
    public function getGenusCategorias()
    {
        return $this->genusCategorias;
    }

}
