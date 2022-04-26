<?php
// api/tests/BooksTest.php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class BookTest extends ApiTestCase
{
    public function testGetCollection(): void
    {
        $response = static::createClient()->request('GET', 'api/books');
        // your assertions here...

        $this->assertResponseIsSuccessful();
    }

    public function testGetItem(): void
    {
        $response = static::createClient()->request('GET', 'api/books/4');
        // your assertions here...

        $this->assertResponseIsSuccessful();
    }

    public function testPostItem(): void
    {
        $response = static::createClient()->request('POST', 'api/books', [
            'json' => [
                'title' => 'foo',
                'description' => 'bar',
                'genre' => 'baz',
                'publicationDate' => '2000-01-01',
                'author' => 'api/authors/1',
                'reviews' => []
            ],
        ]);
        // your assertions here...

        $this->assertResponseIsSuccessful();
    }

    public function testPutItem(): void
    {
        $response = static::createClient()->request('PUT', 'api/books/5', [
            'json' => [
                'title' => 'title updated',
                'description' => 'bar',
                'genre' => 'baz',
                'publicationDate' => '2000-01-01',
                'author' => 'api/authors/1',
                'reviews' => []
            ],
        ]);
        // your assertions here...

        $this->assertResponseIsSuccessful();
    }

    public function testDeleteItem(): void
    {
        $response = static::createClient()->request('DELETE', 'api/books/8');
        // your assertions here...

        $this->assertResponseIsSuccessful();
    }

}