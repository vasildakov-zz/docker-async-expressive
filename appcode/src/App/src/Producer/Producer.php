<?php declare(strict_types = 1);

namespace App\Producer;

use App\Bottle\Bottle;
use Ramsey\Uuid\Uuid;

abstract class Producer
{

    const TYPE_DISTILLERY = 1;

    const TYPE_BRAND = 2;

    const TYPE_BOTTLER = 3;

    /**
     * @var array
     */
    protected $types = [
        self::TYPE_DISTILLERY => 'Distillery',
        self::TYPE_BRAND      => 'Brand',
        self::TYPE_BOTTLER    => 'Bottler',
    ];

    /**
     * @var
     */
    protected $id;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var array $bottles
     */
    protected $bottles;

    /**
     * Distillery constructor.
     * @param $id
     * @param $name
     */
    public function __construct()
    {
        $this->setId((string) Uuid::uuid4());
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
    public function setName($name)
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
     * @param Bottle $bottle
     */
    public function addBottle(Bottle $bottle)
    {
        $this->bottles[] = $bottle;
    }

    /**
     * @return array
     */
    public function getBottles()
    {
        return $this->bottles;
    }
}