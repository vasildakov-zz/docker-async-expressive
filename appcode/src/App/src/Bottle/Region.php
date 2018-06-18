<?php

namespace Domain\Whisky;

class Region
{
    const REGION_HIGHLANDS = 1;

    const REGION_SPEYSIDE = 2;

    const REGION_ISLANDS = 3;

    const REGION_ISLAY = 4;

    const REGION_LOWLANDS = 5;

    const REGION_CAMPBELTOWN  = 6;


    /**
     * @var array
     */
    private static $regions = [
        self::REGION_HIGHLANDS => 'Highlands',
        self::REGION_SPEYSIDE => 'Speyside',
        self::REGION_ISLANDS => 'Islands',
        self::REGION_ISLAY => 'Islay',
        self::REGION_LOWLANDS => 'Lowlands',
        self::REGION_CAMPBELTOWN => 'Campbeltown'
    ];

    /**
     * @var string $name e.g. Highlands, Lowlands, Islay
     */
    private $name;

    /**
     * Region constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
}
