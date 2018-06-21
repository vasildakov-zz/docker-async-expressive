<?php

namespace App\User;


use App\TimeStampable;
use App\User\Collection;

class User
{
    use TimeStampable;

    private $id;

    private $name;

    private $surname;

    private $email;

    /**
     * @var Collection[]
     */
    private $collections;

    private $created;

    private $updated;


    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->setCreated(new \DateTime('now'));
        $this->setUpdated(new \DateTime('now'));
    }


    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
