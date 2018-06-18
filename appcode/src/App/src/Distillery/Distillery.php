<?php declare(strict_types = 1);

namespace App\Distillery;

use App\Producer\Producer;
use Domain\EntityInterface;
use JsonSerializable;

class Distillery extends Producer implements EntityInterface, JsonSerializable
{
    /**
     * @var int
     */
    const STATUS_UNKNOWN = 0;

    /**
     * @var int
     */
    const STATUS_OPERATIONAL = 1;

    protected $statuses = [
        self::STATUS_UNKNOWN     => 'Unknown',
        self::STATUS_OPERATIONAL => 'Operational',
    ];

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var int $founded
     */
    private $founded;

    /**
     * @var array $owners
     */
    private $owners;

    /**
     * @var
     */
    private $location;

    /**
     * @var
     */
    private $status;

    /**
     * @var string $region
     */
    private $region;

    /**
     * @var
     */
    protected $bottles;

    /**
     * @param int|null $status
     * @return Distillery
     */
    public function setStatus(int $status = null) : Distillery
    {
        if (null === $status) {
            $status = self::STATUS_OPERATIONAL;
        }
        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * @param int|null $founded
     * @return $this
     */
    public function setFounded(int $founded = null) : Distillery
    {
        $this->founded = $founded;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFounded() : ?int
    {
        return $this->founded;
    }

    /**
     * The whisky region is optional
     *
     * @param $region
     * @return $this
     */
    public function setRegion($region = null) : Distillery
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'founded'     => $this->founded,
            'region'      => $this->region,
            //'bottles'     => $this->bottles,
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