<?php

namespace Infrastructure\Doctrine\Fixtures;

use App\Slug\Slug;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use App\Bottle\Bottle;

class LoadBottleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 2;
    }

    public function load(ObjectManager $em)
    {
        $reader = new \Zend\Config\Reader\Json();
        $records   = $reader->fromFile('./data/fixtures/bottle.json');

        $hydrator = new DoctrineHydrator($em, Bottle::class);

        foreach ($records as $record) {
            $bottle = $hydrator->hydrate($record, new Bottle());

            $reference = (new Slug())($bottle->getName());
            $bottle->setReference($reference);

            $em->persist($bottle);
            $this->addReference($reference, $bottle);
        }
        $em->flush();
    }
}