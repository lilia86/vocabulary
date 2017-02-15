<?php

namespace Tests\AppBundle\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{

    public function testNewUser()
    {

        $client = $this->makeClient();

        $crawler = $client->request('GET', '/user/create');

        $this->assertStatusCode(200, $client);

        $form = $crawler->selectButton('Submit')->form();

        $form['appbundle_user[username]'] = 'test5';
        $form['appbundle_user[password][first]'] = 'password';
        $form['appbundle_user[password][second]'] = 'password';
        $form['appbundle_user[email]'] = 'email@email.com';
        $form['appbundle_user[locale]']->select('ru');

        $client->submit($form);

        $this->assertTrue(
            $client->getResponse()->isRedirect('/'),
            'response is a redirect to homepage'
        );
        $crawler = $client->followRedirect();
        $this->assertEquals('Твой словарь', $crawler->filter('#lable')->text());

    }

    public function testUpdateUser()
    {

        $client = $this->makeClient();

        $crawler = $client->request('GET', '/user/update/2');

        $this->assertEquals(200, $client);

        $form = $crawler->selectButton('Submit')->form();

        $form['appbundle_user[username]'] = 'test2';
        $form['appbundle_user[password][first]'] = 'test2';
        $form['appbundle_user[password][second]'] = 'test2';
        $form['appbundle_user[email]'] = 'email@email.com';
        $form['appbundle_user[locale]']->select('ru');

        $client->submit($form);
        $this->assertTrue(
            $client->getResponse()->isRedirect('/'),
            'response is a redirect to homepage'
        );
        $crawler = $client->followRedirect();
        $this->assertEquals('Твой словарь', $crawler->filter('#lable')->text());

    }
}
