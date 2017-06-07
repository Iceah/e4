<?php

namespace Inkweb\EleveBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Inkweb\ModuleBundle\Entity\Note;
use Inkweb\UserBundle\Entity\User;

/**
 * Eleve
 *
 * @ORM\Table(name="eleve")
 * @ORM\Entity(repositoryClass="Inkweb\EleveBundle\Repository\EleveRepository")
 */
class Eleve extends User
{

    /**
     * @var int
     *
     * @ORM\Column(name="ine", type="integer", unique=true)
     */
    private $ine;

    /**
     * @ORM\ManyToOne(targetEntity="Inkweb\EleveBundle\Entity\Classe",inversedBy="eleves")
     * @ORM\JoinColumn(nullable=true)
     */
    private  $classe;

    /**
     * @ORM\OneToMany(targetEntity="Inkweb\ModuleBundle\Entity\Note", mappedBy="eleve")
     */

    private $notes;

    /**
     * Set ine
     *
     * @param integer $ine
     * @return Eleve
     */
    public function setIne($ine)
    {
        $this->ine = $ine;

        return $this;
    }

    /**
     * Get ine
     *
     * @return integer 
     */
    public function getIne()
    {
        return $this->ine;
    }


    /**
     * Get Classe
     */
    public function getClasse(){
        return $this->classe;
    }

    /**
     * Set classe
     */
    public function  setClasse(Classe $classe = null){
        $this->classe = $classe;
    }

    public function __construct()

    {
        parent::__construct();
        $this->notes = new ArrayCollection();


    }


    public function addNote(Note $note)

    {

        $this->notes[] = $note;
        $note->setEleve($this);


        return $this;

    }


    public function removeNote(Note $note)

    {

        $this->notes->removeElement($note);

    }


    public function getNotes()

    {

        return $this->notes;

    }
}
