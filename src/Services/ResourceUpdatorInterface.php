<?php

namespace App\Services;

use Symfony\Component\Security\Core\User\UserInterface;

interface ResourceUpdatorInterface
{
    public function proccess(string $method, UserInterface $user): bool;
}