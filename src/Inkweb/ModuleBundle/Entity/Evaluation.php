<?php

namespace Inkweb\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Inkweb\EleveBundle\Entity\Eleve;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Evaluation
 *
 * @ORM\Table(name="evaluation")
 * @ORM\Entity(repositoryClass="Inkweb\ModuleBundle\Repository\EvaluationRepository")
 */
class Evaluation
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
     * @var int
     *
     * @ORM\Column(name="moyenne", type="integer",nullable=true)
     */
    private $moyenne;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="coef", type="integer")
     */
    private $coef;

    /**
     * @ORM\ManyToOne(targetEntity="Inkweb\ModuleBundle\Entity\Module")

     * @ORM\JoinColumn(nullable=false)

     */

    private $module;

    /**
     * @ORM\OneToMany(targetEntity="Inkweb\ModuleBundle\Entity\Note", mappedBy="evaluation" , cascade={"persist", "remove"}, orphanRemoval=true)
     */

    private $notes;



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
     * Get note
     *
     * @return integer 
     */
    public function getMoyenne()
    {
        $array_notes = $this->GetNotes();
        $sum=0;
        foreach ($array_notes as $note){
            $sum = $sum + $note;
        }
        $this->moyenne = $sum / count($array_notes);
        return $this->moyenne;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Evaluation
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Evaluation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set coef
     *
     * @param integer $coef
     * @return Evaluation
     */
    public function setCoef($coef)
    {
        $this->coef = $coef;
        return $this;
    }

    /**
     * Get coef
     *
     * @return integer 
     */
    public function getCoef()
    {
        return $this->coef;
    }


    /**
     * Set Module
     */

    public function setModule(Module $module)

    {

        $this->module = $module;
        return $this;

    }

    /**
     * Get Module
     */
    public function getModule()

    {
        return $this->module;
    }

    public function __construct()

    {

        $this->notes = new ArrayCollection();


    }


    public function addNote(Note $note)

    {

        $this->notes[] = $note;
        $note->setEvaluation($this);


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
