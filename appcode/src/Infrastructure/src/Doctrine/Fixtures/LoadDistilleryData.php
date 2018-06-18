<?php declare(strict_types = 1);

namespace Infrastructure\Doctrine\Fixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\Distillery\Distillery;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

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

        $hydrator = new DoctrineHydrator($em, Distillery::class);

        foreach ($records as $record) {
            $distillery = $hydrator->hydrate($record, new Distillery());

            $em->persist($distillery);
            $this->addReference($record['name'], $distillery);
        }
        $em->flush();
    }
}
