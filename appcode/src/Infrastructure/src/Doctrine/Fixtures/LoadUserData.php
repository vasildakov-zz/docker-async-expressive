<?php declare(strict_types = 1);

namespace Infrastructure\Doctrine\Fixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use App\User\User;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

/**
 * Class LoadDistilleryData
 *
 * @package    Infrastructure\Doctrine\Fixtures
 * @author     Vasil Dakov <vasil.dakov@dunelm.com>
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 1;
    }

    public function load(ObjectManager $em)
    {
        $reader = new \Zend\Config\Reader\Json();
        $records   = $reader->fromFile('./data/fixtures/user.json');

        $hydrator = new DoctrineHydrator($em, User::class);

        foreach ($records as $record) {
            $user = $hydrator->hydrate($record, new User());

            $em->persist($user);
            $this->addReference($record['email'], $user);
        }
        $em->flush();
    }
}
