<?php

namespace App\User;


use App\TimeStampable;
use DateTime;

class Item
{
    use TimeStampable;

    private $id;

    private $bottle;

    /** @var int  The buying price */
    private $price;

    /** @var DateTime $acquired */
    private $acquired;

    private $collection;

    public function __construct()
    {
        $this->setCreated(new \DateTime('now'));
        $this->setUpdated(new \DateTime('now'));
    }

    public function setCollection($collection = null)
    {
        $this->collection = $collection;

        return $this;
    }

    public function getCollection()
    {
        return $this->collection;
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

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

}
