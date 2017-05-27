<?php

namespace Inkweb\EleveBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
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
     * @ORM\OneToOne(targetEntity="Inkweb\EleveBundle\Entity\Classe",cascade={"persist"})
     */
    private  $classe;


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
}
