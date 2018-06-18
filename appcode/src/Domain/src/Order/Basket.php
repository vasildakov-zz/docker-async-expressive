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
            $order->addLine(new OrderLine());
        }

        return $order;
    }
}

// The order
class Order {

    /**
     * @var
     */
    private $user;

    /**
     * @var OrderLine[] $lines
     */
    private $lines = [];

    /**
     * @var Payment One to One, One order has one payment
     */
    private $payment = null;

    /**
     * @var \DateTime $ordered
     */
    private $ordered;

    /**
     * @param OrderLine $line
     */
    public function addLine(OrderLine $line)
    {
        $this->lines[] = $line;
    }

    public function isPaid() : bool
    {
        return $this->payment->success();
    }
}

// The order line
class OrderLine
{
    private $id;

    private $product;

    private $quantity;

    private $total;


}


class Payment
{
    /**
     * @var Order One Payment has One Order
     */
    private $order;

    /** @var \DateTime */
    private $paid;
}
