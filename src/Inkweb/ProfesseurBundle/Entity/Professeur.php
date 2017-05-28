<?php

namespace Inkweb\ProfesseurBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Inkweb\UserBundle\Entity\User;
use Inkweb\ModuleBundle\Entity\Module;

/**
 * Professeur
 *
 * @ORM\Table(name="professeur")
 * @ORM\Entity(repositoryClass="Inkweb\ProfesseurBundle\Repository\ProfesseurRepository")
 */
class Professeur extends User
{

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_embauche", type="date")
     */
    private $dateEmbauche;


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
     * Set dateEmbauche
     *
     * @param \DateTime $dateEmbauche
     * @return Professeur
     */
    public function setDateEmbauche($dateEmbauche)
    {
        $this->dateEmbauche = $dateEmbauche;

        return $this;
    }

    /**
     * Get dateEmbauche
     *
     * @return \DateTime 
     */
    public function getDateEmbauche()
    {
        return $this->dateEmbauche;
    }
}
