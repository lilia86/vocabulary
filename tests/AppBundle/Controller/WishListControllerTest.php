<?php

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\Controller\BaseTestSetup;

class WishListControllerTest extends BaseTestSetup
{

    public function testWishList()
    {

        $client = $this->makeClient();

        $crawler = $client->request('GET', '/wish_list/create');

        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Submit')->form();

        $form['appbundle_user[word]']->select('9');

        $client->submit($form);

        $this->assertTrue(
            $client->getResponse()->isRedirect('/'),
            'response is a redirect to homepage'
        );

    }

    public function testWishListUpdate()
    {

        $client = $this->makeClient();

        $crawler = $client->request('GET', '/wish_list/create');

        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Submit')->form();

        $form['appbundle_user[word]']->select('10');

        $client->submit($form);

        $this->assertTrue(
            $client->getResponse()->isRedirect('/'),
            'response is a redirect to homepage'
        );

    }
}
