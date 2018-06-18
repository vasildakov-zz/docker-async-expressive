<?php declare(strict_types=1);

namespace App\Product;

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
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;


    /**
     * Product constructor.
     * @param $id
     * @param $name
     */
    public function __construct($id, $name, $slug)
    {
        $this->id   = $id;
        $this->name = $name;
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getId() : string
    {
        return (string)$this->id;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug() : string
    {
        return $this->slug;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'id'   => (string) $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
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
