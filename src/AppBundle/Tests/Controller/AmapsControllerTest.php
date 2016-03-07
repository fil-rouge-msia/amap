<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AmapsControllerTest extends WebTestCase
{
    protected static $recordUri = "";

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function test400PostAmaps()
    {
        $this->client->request(
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
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 400);
    }

    public function test201PostAmaps()
    {
        $this->client->request(
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
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 201, false);
        self::$recordUri = $response->headers->get("location");
    }

    public function test200GetAmap()
    {
        $this->client->request(
            'GET',
            self::$recordUri
        );
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 200);

        $json = json_decode($response->getContent());
        $this->assertEquals($json->nom, "test");
    }

    public function test404PutAmaps()
    {
        $this->client->request(
            'PUT',
            '/api/amaps/99999',
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
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 404);
    }

    public function test400PutAmaps()
    {
        $this->client->request(
            'PUT',
            self::$recordUri,
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
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 400);
    }

    public function test204PutAmaps()
    {
        $this->client->request(
            'PUT',
            self::$recordUri,
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{
              "amap": {
                "nom": "test2",
                "lieu": "test2",
                "adresse": "test2",
                "bancaire": "test2"
              }
            }'
        );
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 204, false);
    }

    public function test404GetAmap()
    {
        $this->client->request(
            'GET',
            '/api/amaps/99999'
        );
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 404);
    }

    public function test200GetAfterPutAmap()
    {
        $this->client->request(
            'GET',
            self::$recordUri
        );
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 200);

        $json = json_decode($response->getContent());
        $this->assertEquals($json->nom, "test2");
    }

    public function test404DeleteAmap()
    {
        $this->client->request(
            'DELETE',
            '/api/amaps/99999'
        );
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 404);
    }

    public function test204DeleteAmap()
    {
        $this->client->request(
            'DELETE',
            self::$recordUri
        );
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 204, false);
    }

    public function test404GetAfterDeleteAmap()
    {
        $this->client->request(
            'GET',
            self::$recordUri
        );
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, 404);
    }

    protected function assertJsonResponse($response, $statusCode = 200, $checkValidJson = true)
    {
        $this->assertEquals(
            $statusCode, $response->getStatusCode(),
            $response->getContent()
        );
        
        if ($statusCode != 204) { //https://github.com/symfony/symfony/pull/11244
            $this->assertTrue(
                $response->headers->contains('Content-Type', 'application/json'),
                $response->headers
            );
        }

        if ($checkValidJson) {
            $decode = json_decode($response->getContent());
            $this->assertTrue(($decode != null && $decode != false),
                $response->getContent()
            );
        }
    }

}
