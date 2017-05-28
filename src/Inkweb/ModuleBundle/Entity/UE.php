<?php

namespace Inkweb\ModuleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UE
 *
 * @ORM\Table(name="u_e")
 * @ORM\Entity(repositoryClass="Inkweb\ModuleBundle\Repository\UERepository")
 */
class UE
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
     * @ORM\Column(name="codeue", type="string", length=255, unique=true)
     */
    private $codeue;

    /**
     * @var string
     *
     * @ORM\Column(name="nomue", type="string", length=255)
     */
    private $nomue;


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
     * Set codeue
     *
     * @param string $codeue
     *
     * @return UE
     */
    public function setCodeue($codeue)
    {
        $this->codeue = $codeue;

        return $this;
    }

    /**
     * Get codeue
     *
     * @return string
     */
    public function getCodeue()
    {
        return $this->codeue;
    }

    /**
     * Set nomue
     *
     * @param string $nomue
     *
     * @return UE
     */
    public function setNomue($nomue)
    {
        $this->nomue = $nomue;

        return $this;
    }

    /**
     * Get nomue
     *
     * @return string
     */
    public function getNomue()
    {
        return $this->nomue;
    }
}

