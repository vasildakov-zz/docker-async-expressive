<?php

namespace Basket;

use Doctrine\Common\Collections\ArrayCollection;
use Product\ProductInterface;

class Basket
{
    private $id;

    private $items;

    public function __construct($id)
    {
        $this->id = $id;

        $this->items = new ArrayCollection();
    }

    public function add(ProductInterface $product)
    {
        $this->items->add(new Item());
    }

    public function remove(ProductInterface $product)
    {
        $this->items->remove($product);
    }

    public function createOrder()
    {
        $order = new Order();
        foreach ($this->items as $item) {
            $order->addLine(new Line());
        }

        return $order;
    }
}

// The order
class Order {

    /**
     * @var Line[] $lines
     */
    private $lines = [];

    public function addLine(Line $line)
    {
        $this->lines[] = $line;
    }
}

// The order line
class Line
{
    private $id;
}
