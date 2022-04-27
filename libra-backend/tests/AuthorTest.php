<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Author;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

class AuthorTest extends ApiTestCase
{
    

    public function testGetCollection(): void
    {

        $response = static::createClient()->request('GET', 'api/authors');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }

    public function testPostItem(): void
    {
        $client = static::createClient();

        $client->request('POST', 'api/authors', [
            'json' => [
                'firstName' => 'authorFirstName',
                'lastName' => 'authorLstName',
                'bibliography' => 'the shadow of the sun',
                'books' => []
            ],
        ]);


        $this->assertResponseStatusCodeSame(201);
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
        $this->assertJsonContains([
            '@context' => '/api/contexts/Author',
            '@type' => 'Author',
            'firstName' => 'authorFirstName',
            'lastName' => 'authorLstName',
            'bibliography' => 'the shadow of the sun',
            'books' => array(),
        ]);

        $this->assertMatchesResourceItemJsonSchema(Author::class);
    }


    public function testPutItem(): void
    {

        static::createClient()->request('PUT', 'api/authors/1', [
            'json' => [
                'firstName' => 'authorFirstNameUpdated',
                'lastName' => 'authorLstName',
                'bibliography' => 'the shadow of the sun',
                'books' => []
            ],
        ]);

        $this->assertResponseIsSuccessful();
    }

//    public function testDeleteItem(): void
//    {
//        static::createClient()->request('DELETE', 'api/authors/1');
//
//        $this->assertResponseStatusCodeSame(204);
//    }

}