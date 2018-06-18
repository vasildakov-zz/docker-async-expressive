<?php

namespace Infrastructure\Doctrine\Fixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use App\Product\Product;
use Ramsey\Uuid\Uuid;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 1;
    }

    public function load(ObjectManager $em)
    {
        $factory = new \RandomLib\Factory;
        $generator = $factory->getMediumStrengthGenerator();


        for($i = 1; $i < 100; $i++) {
            $slug = $generator->generateString(6, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
            $product = new Product(Uuid::uuid4(), "Product $i", $slug);
            $em->persist($product);
        }
        $em->flush();
    }
}