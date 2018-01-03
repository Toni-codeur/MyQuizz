<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity(fields={"email", "username"}, message="This one is already taken")
 */
class User implements UserInterface
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
     * @ORM\Column(name="mois", type="integer", nullable=true)
     */
    private $mois = 0;
    /**
     * @var int
     *
     * @ORM\Column(name="status_compte", type="string", length=255)
     */
    private $statusCompte = '0';
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;
    /**
     * @var string
     *
     * @ORM\Column(name="date_connexion", type="datetime", nullable=true)
     */
    private $dateConnexion;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;


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
     * Get mois
     *
     * @return int
     */
    public function getMois()
    {
        return $this->mois;
    }
    /**
     * Set mois
     *
     * @param int $mois
     *
     * @return User
     */
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get status_compte
     *
     * @return string
     */
    public function getStatusCompte()
    {
        return $this->statusCompte;
    }
    /**
     * Set status_compte
     *
     * @param string $statusCompte
     *
     * @return User
     */
    public function setStatusCompte($statusCompte)
    {
        $this->statusCompte = $statusCompte;

        return $this;
    }


    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *      return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a '"roles"' property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return [
           'ROLE_USER'
        ];
    }


    public function getSalt()
    {
       // TODO: Implement getSalt() method.
    }
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
    /**
     * Set dateConnexion
     *
     * @param string $dateConnexion
     *
     * @return User
     */
    public function setDateConnexion($dateConnexion)
    {
        $this->dateConnexion = $dateConnexion;

        return $this;
    }

    /**
     * Get dateConnexion
     *
     * @return string
     */
    public function getDateConnexion()
    {
        return $this->dateConnexion;
    }
}
