<?php

namespace Domain;

class User
{
    private $id;

    private $name;

    private $email;

    public function __construct($id)
    {
        $this->id = $id;
    }
}