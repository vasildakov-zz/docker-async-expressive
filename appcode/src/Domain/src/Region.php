<?php

namespace Domain;

class Region
{
    /**
     * @var
     */
    private $id;

    /**
     * @var string $name e.g. Highlands, Lowlands, Islay
     */
    private $name;

    /**
     * Region constructor.
     * @param $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }
}
