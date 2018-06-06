<?php

namespace Domain;


class Distillery
{
    /**
     * @var
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var int $founded
     */
    private $founded;

    /**
     * @var Company[] $owners
     */
    private $owners;

    private $location;

    private $status;

    /**
     * @var Region $region
     */
    private $region;

    /**
     * @var
     */
    private $bottles;

    /**
     * Distillery constructor.
     * @param $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        $this->setId($id);
        $this->setName($name);
    }

    /**
     * @param $id
     * @return $this
     */
    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $name
     * @return $this
     */
    private function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $region
     * @return $this
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Region
     */
    public function getRegion()
    {
        return $this->region;
    }


    public function addBottle(Bottle $bottle)
    {

    }

    public function removeBottle(Bottle $bottle)
    {

    }

    public function getBottles() {}

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'id'   => $this->getId(),
            'name' => $this->getName(),
            'region' => $this->getRegion(),
        ];
    }
}