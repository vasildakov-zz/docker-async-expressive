<?php declare(strict_types = 1);

namespace Infrastructure\Doctrine\Fixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Domain\Distillery;

/**
 * Class LoadDistilleryData
 *
 * @package    Infrastructure\Doctrine\Fixtures
 * @author     Vasil Dakov <vasil.dakov@dunelm.com>
 */
class LoadDistilleryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 1;
    }

    public function load(ObjectManager $em)
    {
        $reader = new \Zend\Config\Reader\Json();
        $records   = $reader->fromFile('./data/fixtures/distillery.json');
        foreach ($records as $record) {
            $distillery = new Distillery($record['id'], $record['name']);
            $em->persist($distillery);
        }
        $em->flush();
    }

}
