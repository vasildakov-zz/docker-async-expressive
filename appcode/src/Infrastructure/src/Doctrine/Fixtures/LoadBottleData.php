<?php

namespace Infrastructure\Doctrine\Fixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Domain\Bottle;

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
        foreach ($records as $record) {
            $bottle = new Bottle($record['id'], $record['name'], $this->getReference($record['distillery']));
            $em->persist($bottle);
            $this->addReference($record['name'], $bottle);
        }
        $em->flush();
    }
}