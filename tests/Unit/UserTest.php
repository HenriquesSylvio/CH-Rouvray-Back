<?php

namespace App\Tests\Unit;

use App\Entity\Post;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = new User();
    }

    public function testGetEmail(): void
    {
        $value = 'test.test@outlook.fr';
        $response = $this->user->setEmail($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getEmail());
        self::assertEquals($value, $this->user->getUsername());
    }

    public function testGetRoles(): void
    {
        $value = ['ROLE_ADMIN'];
        $response = $this->user->setRoles($value);

        self::assertInstanceOf(User::class, $response);
        self::assertContains('ROLE_USER', $this->user->getRoles());
        self::assertContains('ROLE_ADMIN', $this->user->getRoles());
    }

    public function testGetPassword(): void
    {
        $value = '54875487';
        $response = $this->user->setPassword($value);

        self::assertInstanceOf(User::class, $response);
        self::assertEquals($value, $this->user->getPassword());
    }

//    public function testGetPost() : void
//    {
//        $value = new Post();
//
//        $response = $this->user->addPost($value);
//
//        self::assertInstanceOf(User::class, $response);
//        self::assertCount(1, $this->user->getPosts());
//        self::assertTrue($this->user->getPosts()->contains($value));
//
//        $response = $this->user->removePost($value);
//
//        self::assertInstanceOf(User::class, $response);
//        self::assertCount(0, $this->user->getPosts());
//        self::assertFalse($this->user->getPosts()->contains($value));
//
//
////        self::assertCount(1, $this->user->getPosts());
//    }
}