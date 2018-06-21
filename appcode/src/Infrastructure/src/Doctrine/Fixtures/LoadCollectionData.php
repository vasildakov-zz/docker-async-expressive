<?php declare(strict_types = 1);

namespace Infrastructure\Doctrine\Fixtures;

use App\User\Collection;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

/**
 * Class LoadDistilleryData
 *
 * @package    Infrastructure\Doctrine\Fixtures
 */
class LoadCollectionData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 10;
    }

    public function load(ObjectManager $em)
    {
        $reader = new \Zend\Config\Reader\Json();
        $records   = $reader->fromFile('./data/fixtures/collection.json');

        $hydrator = new DoctrineHydrator($em, Collection::class);

        foreach ($records as $record) {
            $collection = $hydrator->hydrate($record, new Collection());
            $collection->setUser($this->getReference('vasildakov@gmail.com'));

            $em->persist($collection);
            //$this->addReference($record['email'], $user);
        }
        $em->flush();
    }
}
