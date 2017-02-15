<?php

namespace Tests\AppBundle\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class WordControllerTest extends WebTestCase
{

    public function testWord()
    {

        $client = $this->makeClient();

        $crawler = $client->request('GET', '/word/create');

        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Submit')->form();

        $form->setValues(['form[english]' => 'en', 'form[french]' => 'fr',
            'form[german]' => 'de', 'form[russian]' => 'ru',
            'form[ukrainian]' => 'uk']);
        $client->submit($form);
        $this->assertTrue(
            $client->getResponse()->isRedirect('/'),
            'response is a redirect to homepage'
        );
        $crawler = $client->followRedirect();
        $this->assertEquals('Your vocabulary', $crawler->filter('#lable')->text());
    }

    public function testWordUpdate()
    {

        $client = $this->makeClient();

        $crawler = $client->request('GET', '/word/update/1');

        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Submit')->form();

        $form->setValues(['form[english]' => 'en', 'form[french]' => 'fr',
            'form[german]' => 'de', 'form[russian]' => 'ru',
            'form[ukrainian]' => 'uk']);
        $client->submit($form);
        $this->assertTrue(
            $client->getResponse()->isRedirect('/'),
            'response is a redirect to homepage'
        );

    }
}
