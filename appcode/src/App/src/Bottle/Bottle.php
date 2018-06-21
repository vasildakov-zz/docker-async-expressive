<?php declare(strict_types = 1);

namespace App\Bottle;

use App\Producer\Producer;
use App\Slug\Slug;
use App\TimeStampable;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;

class Bottle implements JsonSerializable
{
    use TimeStampable;

    /**
     * @var
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var
     */
    private $type;


    /**
     * @var Producer $producer
     */
    private $producer;

    /**
     * @var int|null
     */
    private $age = null;

    /**
     * @var int|null $vintage
     */
    private $vintage = null;

    /**
     * @var string $reference
     */
    private $reference;

    /**
     * @var \Domain\Price[] $prices
     */
    private $prices;

    /**
     * Bottle constructor.
     * @param $id
     * @param $name
     * @param $producer
     */
    public function __construct()
    {
        $this->prices = new ArrayCollection();
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string|null $reference
     * @return $this
     */
    public function setReference(string $reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param \Domain\Price $price
     */
    public function addPrice(\Domain\Price $price)
    {
        $this->prices->add($price);
    }


    public function getPrices()
    {
        return $this->prices;
    }


    public function addPrices(\Doctrine\Common\Collections\Collection $prices)
    {
        foreach ($prices as $price) {
            $price->setBottle($this);
            $this->prices->add($price);
        }
    }

    public function removePrices(\Doctrine\Common\Collections\Collection $prices)
    {
        foreach ($prices as $price) {
            $price->setBottle(null);
            $this->prices->removeElement($price);
        }
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'distillery' => $this->producer,
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
