<?php declare(strict_types = 1);

namespace Infrastructure\Doctrine\Fixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Domain\Distillery;

class LoadDistilleryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 1;
    }

    public function load(ObjectManager $em)
    {
        $distillery = new Distillery(1, 'Macallan');

        $em->persist($distillery);
        $em->flush();
    }

}
