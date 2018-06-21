<?php

namespace Domain;

use JsonSerializable;

class Price implements JsonSerializable
{
    /**
     * @var string $id
     */
    private $id;

    /**
     * @var Bottle $bottle
     */
    private $bottle;

    /**
     * @var float $amount
     */
    private $amount;

    /**
     * @var \DateTime $created
     */
    private $created;

    /**
     * @var \DateTime $updated
     */
    private $updated;

    /**
     * Price constructor.
     * @param $id
     * @param $bottle
     * @param $amount
     * @param $currency
     */
    public function __construct()
    {
        $this->created = new \DateTime('now');
        $this->updated = new \DateTime('now');
    }


    public function setBottle($bottle)
    {
        $this->bottle = $bottle;

        return $this;
    }

    public function getBottle()
    {
        return $this->bottle;
    }


    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
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
        // TODO: Implement jsonSerialize() method.
    }
}
