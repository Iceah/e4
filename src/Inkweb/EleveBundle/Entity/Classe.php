<?php

namespace Inkweb\EleveBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Inkweb\ModuleBundle\Entity\Module;

/**
 * Classe
 *
 * @ORM\Table(name="classe")
 * @ORM\Entity(repositoryClass="Inkweb\EleveBundle\Repository\ClasseRepository")
 */
class Classe
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="annee", type="date")
     */
    private $annee;


    /*
     * @ORM\OneToMany(targetEntity="Inkweb\EleveBundle\Entity\Eleve", mappedBy="classes")
     */
    private $eleves;

    /**
     * @ORM\OneToMany(targetEntity="Inkweb\ModuleBundle\Entity\Module", mappedBy="classe" )
     */

    private $modules;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Classe
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set annee
     *
     * @param \DateTime $annee
     * @return Classe
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return \DateTime
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    public function __construct()

    {

        $this->eleves = new ArrayCollection();
        $this->modules = new ArrayCollection();

    }


    public function addEleve(Eleve $eleve)

    {

        $this->eleves[] = $eleve;
        $eleve->setNom($this);

    }


    public function removeEleve(Eleve $eleve)

    {

        $this->eleves->removeElement($eleve);

    }


    public function getEleves()

    {

        return $this->eleves;

    }

    public function getModules()

    {

        return $this->modules;

    }
    
}
