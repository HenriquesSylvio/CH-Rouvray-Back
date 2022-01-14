<?php

namespace App\Tests\Unit;

use App\Entity\User;
use App\Entity\Post;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    private Post $post;

    protected function setUp(): void
    {
        parent::setUp();

        $this->post = new Post();
    }

    public function testGetName(): void
    {
        $value = 'Test';

        $response = $this->post->setName($value);

        self::assertInstanceOf(Post::class, $response);
        self::assertEquals($value, $this->post->getName());
    }

    public function testGetContent(): void
    {
        $value = 'Test';

        $response = $this->post->setContent($value);

        self::assertInstanceOf(Post::class, $response);
        self::assertEquals($value, $this->post->getContent());
    }

    public function testGetAuthor(): void
    {
        $value = new User();

        $response = $this->post->setAuthor($value);

        self::assertInstanceOf(Post::class, $response);
        self::assertInstanceOf(User::class, $this->post->getAuthor());
    }

}