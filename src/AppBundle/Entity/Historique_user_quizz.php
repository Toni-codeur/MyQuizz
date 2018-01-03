<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historique_user_quizz
 *
 * @ORM\Table(name="historique_user_quizz")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Historique_user_quizzRepository")
 */
class Historique_user_quizz
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;
    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="categorie_quizz", type="integer")
     */
    private $categorieQuizz;

    /**
     * @var string
     *
     * @ORM\Column(name="score", type="string", length=255)
     */
    private $score;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_user", type="string", length=255)
     */
    private $ipUser;


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Historique_user_quizz
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set categorieQuizz
     *
     * @param integer $categorieQuizz
     *
     * @return Historique_user_quizz
     */
    public function setCategorieQuizz($categorieQuizz)
    {
        $this->categorieQuizz = $categorieQuizz;

        return $this;
    }

    /**
     * Get categorieQuizz
     *
     * @return int
     */
    public function getCategorieQuizz()
    {
        return $this->categorieQuizz;
    }

    /**
     * Set score
     *
     * @param string $score
     *
     * @return Historique_user_quizz
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return string
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set ipUser
     *
     * @param string $ipUser
     *
     * @return Historique_user_quizz
     */
    public function setIpUser($ipUser)
    {
        $this->ipUser = $ipUser;

        return $this;
    }

    /**
     * Get ipUser
     *
     * @return string
     */
    public function getIpUser()
    {
        return $this->ipUser;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Historique_user_quizz
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}

