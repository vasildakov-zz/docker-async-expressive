<?php

namespace Domain;


class Bottle
{
    /**
     * @var
     */
    private $id;

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
     * Bottle constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }
}
