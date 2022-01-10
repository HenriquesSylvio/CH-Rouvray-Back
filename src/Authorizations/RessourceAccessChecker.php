<?php

namespace App\Authorizations;


use App\Exceptions\ResourceAccessException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class RessourceAccessChecker implements RessourceAccessCheckerInterface
{
    private ?UserInterface $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function canAccess(?int $id): void
    {
        if (!in_array("ROLE_ADMIN", $this->user->getRoles())) {
            if ($this->user->getId() !== $id) {
                throw new ResourceAccessException(Response::HTTP_UNAUTHORIZED, self::MESSAGE_ERROR);
            }
        }
    }
}