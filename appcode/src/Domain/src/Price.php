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
     * @var string $currency
     */
    private $currency;

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
    public function __construct($id, $bottle, $amount, $currency)
    {
        $this->id       = $id;
        $this->bottle   = $bottle;
        $this->amount   = $amount;
        $this->currency = $currency;

        $this->created = new \DateTime('now');
        $this->updated = new \DateTime('now');
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
