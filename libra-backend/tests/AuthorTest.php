<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Author;

class AuthorTest extends ApiTestCase
{


    public function testGetAuthors(): void
    {

        static::createClient()->request('GET', 'api/authors');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }

    public function testPostAuthor(): void
    {

        static::createClient()->request('POST', 'api/authors', [
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


    public function testUpdateAuthor(): void
    {
        $response = static::createClient()->request('POST', 'api/authors', [

            'json' => [

                'firstName' => 'authorFirstName',

                'lastName' => 'authorLstName',

                'bibliography' => 'the shadow of the sun',

                'books' => []

            ],

        ]);

        $iri = $response->toArray()['@id'];

        static::createClient()->request('PUT', $iri, [
            'json' => [

                'firstName' => 'authorFirstNameUpdated',

            ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([

            '@id' => $iri,

            'firstName' => 'authorFirstNameUpdated',

        ]);


    }

    public function testDeleteAuthor(): void
    {

        $iri = static::createClient()->request('POST', 'api/authors', [

            'json' => [

                'firstName' => 'authorFirstName',

                'lastName' => 'authorLstName',

                'bibliography' => 'the shadow of the sun',

                'books' => []

            ],

        ])->toArray()['@id'];

        static::createClient()->request('DELETE', $iri);

        $this->assertResponseStatusCodeSame(204);
    }

}