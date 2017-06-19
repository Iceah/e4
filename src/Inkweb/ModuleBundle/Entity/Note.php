<?php

namespace Inkweb\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Inkweb\EleveBundle\Entity\Eleve;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="Inkweb\ModuleBundle\Repository\NoteRepository")
 */
class Note
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
     * @ORM\Column(name="note", type="decimal", precision=2, scale=0)
     * @Assert\Range(
     * min = 0,
     * max = 20,
     * minMessage = "Vous devez saisir une valeur supérieur à 0",
     * maxMessage = "Vous devez saisir une valeur inférieur ou égale à 20"
     * )
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="Inkweb\ModuleBundle\Entity\Evaluation",inversedBy="notes",cascade={"persist"})

     * @ORM\JoinColumn(nullable=false)

     */

    private $evaluation;

    /**
     * @ORM\ManyToOne(targetEntity="Inkweb\EleveBundle\Entity\Eleve",inversedBy="notes",cascade={"persist"})

     * @ORM\JoinColumn(nullable=false)

     */

    private $eleve;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Note
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }


    /**
     * Set Evaluation
     */

    public function setEvaluation(Evaluation $evaluation)

    {

        $this->evaluation = $evaluation;
        return $this;

    }

    /**
     * Get Evaluation
     */
    public function getEvaluation()

    {
        return $this->evaluation;
    }

    /**
     * Set Eleve
     */

    public function setEleve(Eleve $eleve)

    {

        $this->eleve = $eleve;
        return $this;

    }

    /**
     * Get Eleve
     */
    public function getEleve()

    {
        return $this->eleve;
    }
}

