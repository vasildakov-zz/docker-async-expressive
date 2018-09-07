<?php

namespace App\User;

use App\TimeStampable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection as CollectionInterface;
use Ramsey\Uuid\Uuid;

class Collection
{
    use TimeStampable;

    /**
     * @var Uuid $id
     */
    private $id;

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $name;

    /**
     * @var ArrayCollection
     */
    private $items;

    /**
     * Collection constructor.
     * @param User $user
     */
    public function __construct()
    {
        $this->setCreated(new \DateTime('now'));
        $this->setUpdated(new \DateTime('now'));

        $this->items = new ArrayCollection();
    }

    /**
     * @param User $user
     * @return Collection
     */
    public function setUser(User $user): Collection
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param Item $item
     */
    public function addItem(Item $item)
    {
        $this->items->add($item);
    }

    /**
     * @param CollectionInterface $items
     */
    public function addItems(CollectionInterface $items)
    {
        foreach ($items as $item) {
            $item->setCollection($this);
            $this->items->add($item);
        }
    }

    /**
     * @param CollectionInterface $items
     */
    public function removeItems(CollectionInterface $items)
    {
        foreach ($items as $item) {
            $item->setCollection(null);
            $this->items->removeElement($item);
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }
}
