<?php

namespace App\Services;

use App\Authorizations\AuthentificationChecker;
use App\Authorizations\AuthentificationCheckerInterface;
use App\Authorizations\RessourceAccessCheckerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class ResourceUpdator implements ResourceUpdatorInterface
{
    protected array $methodAllowed = [
        Request::METHOD_PUT,
        Request::METHOD_PATCH,
        Request::METHOD_DELETE,
    ];

    private $ressourceAccessChecker;
    private $authentificationChecker;

    public function __construct(
        RessourceAccessCheckerInterface $ressourceAccessChecker,
        AuthentificationCheckerInterface $authentificationChecker
    ){
        $this->ressourceAccessChecker = $ressourceAccessChecker;
        $this->authentificationChecker = $authentificationChecker;
    }

    public function proccess(string $method, UserInterface $user): bool
    {
        if (in_array($method, $this->methodAllowed, true)){
            $this->authentificationChecker->isAuthenticated();
            $this->ressourceAccessChecker->canAccess($user->getId());
            return true;
        }
        return false;
    }
}