<?php

namespace Domain;


class Distillery
{
    private $id;

    private $name;

    public function __construct($id, $name)
    {
        $this->setId($id);
        $this->setName($name);
    }

    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    private function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }


    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
        ];
    }
}