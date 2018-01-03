<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InfosUser
 *
 * @ORM\Table(name="infos_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InfosUserRepository")
 */
class InfosUser
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
     * @ORM\Column(name="id_user", type="integer", nullable=true)
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="visiteur", type="integer", nullable=true)
     */
    private $visiteur;

    /**
     * @var int
     *
     * @ORM\Column(name="inscrit", type="integer", nullable=true)
     */
    private $inscrit;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_quizz_effectuer_annee", type="integer", nullable=true)
     */
    private $nbQuizzEffectuerAnnee;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_quizz_effectuer_mois", type="integer", nullable=true)
     */
    private $nbQuizzEffectuerMois;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_quizz_effectuer_semaine", type="integer", nullable=true)
     */
    private $nbQuizzEffectuerSemaine;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_quizz_effectuer_24h", type="integer", nullable=true)
     */
    private $nbQuizzEffectuer24h;

    /**
     * @var string
     *
     * @ORM\Column(name="theme_choix_quizz", type="string", length=255, nullable=true)
     */
    private $themeChoixQuizz;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_user", type="string", length=255, nullable=true)
     */
    private $ipUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


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
     * Set visiteur
     *
     * @param integer $visiteur
     *
     * @return Visiteur
     */
    public function setVisiteur($visiteur)
    {
        $this->visiteur = $visiteur;

        return $this;
    }

    /**
     * Get visiteur
     *
     * @return int
     */
    public function getvisiteur()
    {
        return $this->visiteur;
    }

    /**
     * Set inscrit
     *
     * @param integer $inscrit
     *
     * @return Inscrit
     */
    public function setInscrit($inscrit)
    {
        $this->inscrit = $inscrit;

        return $this;
    }

    /**
     * Get inscrit
     *
     * @return int
     */
    public function getInscrit()
    {
        return $this->inscrit;
    }



    /**
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return InfosUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set nbQuizzEffectuerAnnee
     *
     * @param integer $nbQuizzEffectuerAnnee
     *
     * @return InfosUser
     */
    public function setNbQuizzEffectuerAnnee($nbQuizzEffectuerAnnee)
    {
        $this->nbQuizzEffectuerAnnee = $nbQuizzEffectuerAnnee;

        return $this;
    }

    /**
     * Get nbQuizzEffectuerAnnee
     *
     * @return int
     */
    public function getNbQuizzEffectuerAnnee()
    {
        return $this->nbQuizzEffectuerAnnee;
    }

    /**
     * Set nbQuizzEffectuerMois
     *
     * @param integer $nbQuizzEffectuerMois
     *
     * @return InfosUser
     */
    public function setNbQuizzEffectuerMois($nbQuizzEffectuerMois)
    {
        $this->nbQuizzEffectuerMois = $nbQuizzEffectuerMois;

        return $this;
    }

    /**
     * Get nbQuizzEffectuerMois
     *
     * @return int
     */
    public function getNbQuizzEffectuerMois()
    {
        return $this->nbQuizzEffectuerMois;
    }

    /**
     * Set nbQuizzEffectuerSemaine
     *
     * @param integer $nbQuizzEffectuerSemaine
     *
     * @return InfosUser
     */
    public function setNbQuizzEffectuerSemaine($nbQuizzEffectuerSemaine)
    {
        $this->nbQuizzEffectuerSemaine = $nbQuizzEffectuerSemaine;

        return $this;
    }

    /**
     * Get nbQuizzEffectuerSemaine
     *
     * @return int
     */
    public function getNbQuizzEffectuerSemaine()
    {
        return $this->nbQuizzEffectuerSemaine;
    }

    /**
     * Set nbQuizzEffectuer24h
     *
     * @param integer $nbQuizzEffectuer24h
     *
     * @return InfosUser
     */
    public function setNbQuizzEffectuer24h($nbQuizzEffectuer24h)
    {
        $this->nbQuizzEffectuer24h = $nbQuizzEffectuer24h;

        return $this;
    }

    /**
     * Get nbQuizzEffectuer24h
     *
     * @return int
     */
    public function getNbQuizzEffectuer24h()
    {
        return $this->nbQuizzEffectuer24h;
    }

    /**
     * Set themeChoixQuizz
     *
     * @param string $themeChoixQuizz
     *
     * @return InfosUser
     */
    public function setThemeChoixQuizz($themeChoixQuizz)
    {
        $this->themeChoixQuizz = $themeChoixQuizz;

        return $this;
    }

    /**
     * Get themeChoixQuizz
     *
     * @return string
     */
    public function getThemeChoixQuizz()
    {
        return $this->themeChoixQuizz;
    }

    /**
     * Set ipUser
     *
     * @param string $ipUser
     *
     * @return IpUser
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
     * @return InfosUser
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

