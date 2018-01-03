<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Response
 *
 * @ORM\Table(name="reponse")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ResponseRepository")
 */
class Reponse
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
     * @ORM\Column(name="check_reponse", type="integer", nullable=true)
     */
    private $checkReponse;

    /**
     * Get checkReponse
     *
     * @return int
     */
    public function getCheckReponse()
    {
        return $this->checkReponse;
    }
    /**
     * Set checkReponse
     *
     * @param int $checkReponse
     *
     * @return Question
     */
    public function setCheckQuestion($checkReponse)
    {
        $this->checkReponse = $checkReponse;

        return $this;
    }
    /**
     * @var int
     * @Assert\NotBlank()
     * @Assert\Length(min=1)
     * @ORM\Column(name="id_question", type="integer", nullable=true)
     */
    private $idQuestion;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     * @ORM\Column(name="reponse", type="string", length=255, nullable=true)
     */
    private $reponse;

    /**
     * @var Question
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="reponse", fetch="EAGER")
     * @ORM\JoinColumn(name="id_question", referencedColumnName="id")
     */
    private $question;
    public function getQuestion()
    {
        return $this->question;
    }
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
     * Set idQuestion
     *
     * @param integer $idQuestion
     *
     * @return Response
     */
    public function setIdQuestion($idQuestion)
    {
        $this->idQuestion = $idQuestion;

        return $this;
    }

    /**
     * Get idQuestion
     *
     * @return int
     */
    public function getIdQuestion()
    {
        return $this->idQuestion;
    }

    /**
     * Set reponse
     *
     * @param string $reponse
     *
     * @return Response
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }
}

