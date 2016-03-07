<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AmapsControllerTest extends WebTestCase
{
    public function test400PostAmaps()
    {
        $client = static::createClient();

        $client->request(
            'POST', 
            '/api/amaps',  
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{
              "amap": {
                "nom": "",
                "lieu": "",
                "adresse": "",
                "bancaire": ""
              }
            }'
        );
        $response = $client->getResponse();
        $this->assertJsonResponse($client->getResponse(), 400, false);
    }

    public function test201PostAmaps()
    {
        $client = static::createClient();

        $client->request(
            'POST', 
            '/api/amaps',  
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{
              "amap": {
                "nom": "test",
                "lieu": "test",
                "adresse": "test",
                "bancaire": "test"
              }
            }'
        );
        $response = $client->getResponse();
        $this->assertJsonResponse($client->getResponse(), 201, false);
    }

    /*public function testGetamap()
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
    }*/

    protected function assertJsonResponse($response, $statusCode = 200, $checkValidJson = true)
    {
        $this->assertEquals(
            $statusCode, $response->getStatusCode(),
            $response->getContent()
        );
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );

        if ($checkValidJson) {
            $decode = json_decode($response->getContent());
            $this->assertTrue(($decode != null && $decode != false),
                $response->getContent()
            );
        }
    }

}
