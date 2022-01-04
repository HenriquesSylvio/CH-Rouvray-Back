<?php

declare(strict_types=1);

namespace App\Authorizations;

use App\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class PostAuthorizationChecker
{
    private array $methodAllowed = [
        Request::METHOD_PUT,
        Request::METHOD_PATCH,
        Request::METHOD_DELETE
    ];
    private ?UserInterface $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function check(Post $post, string $method): void
    {
        $this->isAuthenticated();

        if (!in_array("ROLE_ADMIN", $this->user->getRoles()))
        {
            if ($this->isMethodAllowed($method) && $post->getAuthor()->getId() !== $this->user->getId())
            {
                $errorMessage = "Vous n'êtes pas autorisé a faire cette action";
                //$errorMessage  = implode(",", $this->user->getRoles());
                throw new UnauthorizedHttpException($errorMessage, $errorMessage);
            }
        }
    }

    public function isAuthenticated(): void
    {
        if (null === $this->user) {
            $errorMessage = "Vous n'êtes pas authentifié";
            throw new UnauthorizedHttpException($errorMessage, $errorMessage);
        }
    }

    public function isMethodAllowed(string $method): bool
    {
        return in_array($method, $this->methodAllowed, true);
    }
}
