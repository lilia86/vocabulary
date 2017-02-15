<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\WishList;

class LoadWishListData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $wishlist1 = new WishList();
        $wishlist1->setUser($this->getReference('test1'));
        $wishlist1->addWord($this->getReference('word1'));
        $wishlist1->addWord($this->getReference('word2'));

        $wishlist2 = new WishList();
        $wishlist2->setUser($this->getReference('test2'));
        $wishlist2->addWord($this->getReference('word1'));
        $wishlist2->addWord($this->getReference('word2'));
        $wishlist2->addWord($this->getReference('word3'));


        $manager->persist($wishlist1);
        $manager->persist($wishlist2);
        $manager->flush();

        $this->addReference('wishlist1', $wishlist1);
        $this->addReference('wishlist2', $wishlist2);

        $manager->flush();

    }

    public function getOrder()
    {
        return 3;
    }
}
