<?php declare(strict_types = 1);

namespace Domain;

use JsonSerializable;

class Bottle implements JsonSerializable
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
     * @var Distillery $distillery
     */
    private $distillery;

    /**
     * @var int|null
     */
    private $age = null;

    /**
     * @var int|null
     */
    private $vintage = null;

    /**
     * @var Price[] $prices
     */
    private $prices;

    /**
     * Bottle constructor.
     * @param $id
     * @param $name
     * @param $distillery
     */
    public function __construct($id, $name, $distillery)
    {
        $this->id = $id;
        $this->name = $name;
        $this->distillery = $distillery;
    }

    /**
     * @param Price $price
     */
    public function addPrice(Price $price)
    {
        $this->prices[] = $price;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'distillery' => $this->distillery,
        ];
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
