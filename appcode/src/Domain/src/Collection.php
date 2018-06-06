<?php

namespace Domain;


class Collection
{
    const TYPE_WISHLIST = 'wishlist';

    const TYPE_OWNED = 'owned';

    private $id;

    private $name;

    private $type;

    private $user;

    private $bottles;

    public function __construct($id, $name, $type, $user)
    {
        $this->id = $id;
    }

    public function addBottle(Bottle $bottle)
    {

    }

    public function removeBottle(Bottle $bottle)
    {

    }

    public function getBottles()
    {
        return $this->bottles;
    }
}
