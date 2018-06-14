<?php declare(strict_types=1);

namespace Product;

/**
 * Class Product
 *
 * @author     Vasil Dakov <vasildakov@gmail.com>
 */
class Product implements \JsonSerializable
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $name;

    /**
     * Product constructor.
     * @param $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'id'   => $this->id,
            'name' => $this->name,
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
