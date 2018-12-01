<?php
/**
 * Created by PhpStorm.
 * User: aniselaroui
 * Date: 01/12/18
 * Time: 12:42
 */

namespace App\Tests\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Client;

class BookApiTest extends WebTestCase
{
    const  AUTHENTICATION = '/login_check';

    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testGetBook()
    {
        $token = $this->getToken('anisAr', '20365270');
        $this->client->setServerParameter('HTTP_AUTHORIZATION', "Bearer $token");

        $this->client->request('GET', '/api/books', array(
            'id' => 1,
        ));
        $response = $this->client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testPostBook()
    {
        $token = $this->getToken('anisAr', '20365270');
        $this->client->setServerParameter('HTTP_AUTHORIZATION', "Bearer $token");

        $this->client->request('Post', '/api/books', array(
            "isbn"=> "9781782164104",
            "title"=> "Persistence in PHP with the Doctrine ORM",
            "description"=> "This book is designed for PHP developers and architects who want to modernize their skills through better understanding of Persistence and ORM.",
            "author"=> "Kévin Dunglas",
            "publicationDate"=> "2013-12-01"
        ));
        $response = $this->client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
    }

    /**
     * Get access token from authentication WS
     *
     * @param $username
     * @param $password
     * @return mixed
     */
    protected function getToken($username, $password)
    {
        $this->client->request('POST', self::AUTHENTICATION, [
            '_username' => $username,
            '_password' => $password
        ]);

        $result = (array)json_decode($this->client->getResponse()->getContent(), true);

        return $result['token'];
    }
}
