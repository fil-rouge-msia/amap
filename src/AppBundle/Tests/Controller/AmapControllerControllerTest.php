<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AmapControllerControllerTest extends WebTestCase
{
    public function testGetamaps()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/amap/');
    }

    public function testGetamap()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getAmap');
    }

    public function testDeleteamap()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteAmap');
    }

    public function testPutamap()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/putAmap');
    }

}
