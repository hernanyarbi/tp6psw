<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evaluacion
 *
 * @ORM\Table(name="evaluacion")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\EvaluacionRepository")
 */
class Evaluacion
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
     * @ORM\Column(name="lu", type="string", length=10)
     */
    private $lu;

    /**
     * @var int
     *
     * @ORM\Column(name="notaConcepto", type="integer")
     */
    private $notaConcepto;

    /**
     * @var int
     *
     * @ORM\Column(name="notaEscrito", type="integer")
     */
    private $notaEscrito;

    /**
     * @var int
     *
     * @ORM\Column(name="notaOral", type="integer")
     */
    private $notaOral;


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
     * Set lu
     *
     * @param string $lu
     *
     * @return Evaluacion
     */
    public function setLu($lu)
    {
        $this->lu = $lu;

        return $this;
    }

    /**
     * Get lu
     *
     * @return string
     */
    public function getLu()
    {
        return $this->lu;
    }

    /**
     * Set notaConcepto
     *
     * @param integer $notaConcepto
     *
     * @return Evaluacion
     */
    public function setNotaConcepto($notaConcepto)
    {
        $this->notaConcepto = $notaConcepto;

        return $this;
    }

    /**
     * Get notaConcepto
     *
     * @return int
     */
    public function getNotaConcepto()
    {
        return $this->notaConcepto;
    }

    /**
     * Set notaEscrito
     *
     * @param integer $notaEscrito
     *
     * @return Evaluacion
     */
    public function setNotaEscrito($notaEscrito)
    {
        $this->notaEscrito = $notaEscrito;

        return $this;
    }

    /**
     * Get notaEscrito
     *
     * @return int
     */
    public function getNotaEscrito()
    {
        return $this->notaEscrito;
    }

    /**
     * Set notaOral
     *
     * @param integer $notaOral
     *
     * @return Evaluacion
     */
    public function setNotaOral($notaOral)
    {
        $this->notaOral = $notaOral;

        return $this;
    }

    /**
     * Get notaOral
     *
     * @return int
     */
    public function getNotaOral()
    {
        return $this->notaOral;
    }
}

