<?php

namespace Inkweb\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Inkweb\ProfesseurBundle\Entity\Professeur;

/**
 * Module
 *
 * @ORM\Table(name="module")
 * @ORM\Entity(repositoryClass="Inkweb\ModuleBundle\Repository\ModuleRepository")
 */
class Module
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
     * @ORM\Column(name="code_mat", type="string", length=10, unique=true)
     */
    private $codeMat;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_mat", type="string", length=255)
     */
    private $nomMat;

    /**
     * @var int
     *
     * @ORM\Column(name="coef_mat", type="integer")
     */
    private $coefMat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date")
     */
    private $dateFin;

    /**

     * @ORM\ManyToOne(targetEntity="Inkweb\ProfesseurBundle\Entity\Professeur")

     * @ORM\JoinColumn(nullable=false)

     */

    private $professeur;

    /**
     * @ORM\ManyToOne(targetEntity="Inkweb\ModuleBundle\Entity\UE")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ue;

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
     * Set codeMat
     *
     * @param string $codeMat
     * @return Module
     */
    public function setCodeMat($codeMat)
    {
        $this->codeMat = $codeMat;

        return $this;
    }

    /**
     * Get codeMat
     *
     * @return string 
     */
    public function getCodeMat()
    {
        return $this->codeMat;
    }

    /**
     * Set nomMat
     *
     * @param string $nomMat
     * @return Module
     */
    public function setNomMat($nomMat)
    {
        $this->nomMat = $nomMat;

        return $this;
    }

    /**
     * Get nomMat
     *
     * @return string 
     */
    public function getNomMat()
    {
        return $this->nomMat;
    }

    /**
     * Set coefMat
     *
     * @param integer $coefMat
     * @return Module
     */
    public function setCoefMat($coefMat)
    {
        $this->coefMat = $coefMat;

        return $this;
    }

    /**
     * Get coefMat
     *
     * @return integer 
     */
    public function getCoefMat()
    {
        return $this->coefMat;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Module
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Module
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    public function setProfesseur(Professeur $professeur)

    {
        $this->professeur = $professeur;
        return $this;
    }


    public function getProfesseur()

    {
        return $this->professeur;
    }

    public function setUe(ue $ue){
        $this->ue = $ue;
        return $this;
    }

    public function getUe()

    {
        return $this->ue;
    }


}
