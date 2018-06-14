<?php

namespace App\Entity;


class Brand
{
    private $id;

    private $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}