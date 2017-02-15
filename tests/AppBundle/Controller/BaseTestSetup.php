<?php

namespace Tests\AppBundle\Controller;
use Doctrine\ORM\Tools\SchemaTool;
use Liip\FunctionalTestBundle\Test\WebTestCase;

abstract class BaseTestSetup extends WebTestCase
{
    protected $client;
    protected $container;
    protected $em;


    protected function setUp()
    {
        $this->client = static::createClient();
        $this->container = $this->client->getContainer();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        if (!isset($metadatas)) {
            $metadatas = $this->em->getMetadataFactory()->getAllMetadata();
        }
        $schemaTool = new SchemaTool($this->em);
        $schemaTool->dropDatabase();
        if (!empty($metadatas)) {
            $schemaTool->createSchema($metadatas);
        }
        $this->postFixtureSetup();

        $this->loadFixtures(array(
            'AppBundle\DataFixtures\LoadUserData',
            'AppBundle\DataFixtures\LoadWordData',
            'AppBundle\DataFixtures\LoadWishListData'
        ));

    }
}
