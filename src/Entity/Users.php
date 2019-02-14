<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=191, unique=true)
     */
    private $Username;

    /**
     * @ORM\Column(type="string", length=191, unique=true )
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(){
        return[
            'ROLE_USER'
        ];
    }

    public function getSalt(){}

    public function eraseCredentials(){}

    public function serialize(){
        return serailize([
            $this->id,
            $this->firstname,
            $this->lastname,
            $this->username,
            $this->password
        ]);
    }


    public function unserialize($string){
        list(
            $this->id,
            $this->firstname,
            $this->lastname,
            $this->username,
            $this->password
        ) = unserialize($string, ['allowed_classes' => false]);
    }
}
