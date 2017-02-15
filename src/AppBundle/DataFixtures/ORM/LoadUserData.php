<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('test1');
        $user1->setPassword('test1');
        $user1->setEmail('john@gmail.com');
        $user1->setLocale('en');

        $user2 = new User();
        $user2->setUsername('test2');
        $user2->setPassword('tets2');
        $user2->setEmail('alice@gmail.com');
        $user2->setLocale('ru');

        $manager->persist($user1);
        $manager->persist($user2);
        $manager->flush();

        $this->addReference('test1', $user1);
        $this->addReference('test2', $user2);
    }

    public function getOrder()
    {
        return 2;
    }
}
