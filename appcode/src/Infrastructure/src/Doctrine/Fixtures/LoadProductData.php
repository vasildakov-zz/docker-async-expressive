<?php

namespace Infrastructure\Doctrine\Fixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Product\Product;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 1;
    }

    public function load(ObjectManager $em)
    {
        for($i = 1; $i < 100; $i++) {
            $product = new Product($i, "Product $i");
            $em->persist($product);
        }
        $em->flush();
    }
}