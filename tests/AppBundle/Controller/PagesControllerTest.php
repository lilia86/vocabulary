<?php

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\Controller\BaseTestSetup;


class PagesControllerTest extends BaseTestSetup
{
    public function testIndex()
    {
        $client = $this->makeClient();

        $crawler = $client->request('GET', '/');

        $this->assertStatusCode(200, $client);
    }

    public function testSlider()
    {


        $client = $this->makeClient();

        $crawler = $client->request('GET', '/slider', array(), array(), array(
            'PHP_AUTH_USER' => 'test1',
            'PHP_AUTH_PW'   => 'test1',
        ));

        $this->assertStatusCode(200, $client);

        $this->assertEquals('Your vocabulary', $crawler->filter('#lable')->text());

    }




}
