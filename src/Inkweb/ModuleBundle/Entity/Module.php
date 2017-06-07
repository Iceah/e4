<?php

namespace Inkweb\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Inkweb\EleveBundle\Entity\Classe;
use Inkweb\ProfesseurBundle\Entity\Professeur;
use Symfony\Component\Form\Form;

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
     * @var int
     *
     * @ORM\Column(name="avancement", type="integer", nullable=true)
     */
    private $avancement = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="avancement_max", type="integer")
     */
    private $avancement_max;

    /**
     * @var string
     *
     * @ORM\Column(name="notemodule",type="string", length=255, nullable=true)
     */
    private $notemodule;

    /**
     * @ORM\ManyToOne(targetEntity="Inkweb\EleveBundle\Entity\Classe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classe;

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

    public function setUe(UE $ue){
        $this->ue = $ue;
        return $this;
    }

    public function getUe()

    {
        return $this->ue;
    }

    public function setClasse(Classe $classe){
        $this->classe = $classe;
        return $this;
    }

    public function getClasse()

    {
        return $this->classe;
    }

    /**
     * Set avancement
     *
     * @param int $avancement
     * @return Module
     */
    public function setAvancement($avancement)
    {
        $this->avancement = $avancement;

        return $this;
    }

    /**
     * Get avancement
     *
     * @return int
     */
    public function getAvancement()
    {
        return $this->avancement;
    }

    /**
     * Set avancement_max
     *
     * @param int $avancement_max
     * @return Module
     */
    public function setAvancementMax($avancement_max)
    {
        $this->avancement_max = $avancement_max;

        return $this;
    }

    /**
     * Get avancement_max
     *
     * @return int
     */
    public function getAvancementMax()
    {
        return $this->avancement_max;
    }

    /*
     * Set note_module
     * @param string $note_module
     * @return Module
     */
    public function setNoteModule($notemodule){
        $this->notemodule = $notemodule;
        return $this;
    }
    /*
     * Get Note Module
     * @return string
     */
    public function getNoteModule(){
        return $this->notemodule;
    }
}
