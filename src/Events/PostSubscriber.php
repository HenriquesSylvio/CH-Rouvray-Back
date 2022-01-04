<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Authorizations\PostAuthorizationChecker;
use App\Authorizations\UserAuthorizationChecker;
use App\Entity\Post;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class PostSubscriber implements EventSubscriberInterface
{
    private array $methodNotAllowed = [
        Request::METHOD_POST,
        Request::METHOD_GET
    ];
    private PostAuthorizationChecker $postAuthorizationChecker;

    public function __construct(PostAuthorizationChecker $postAuthorizationChecker)
    {
        $this->postAuthorizationChecker = $postAuthorizationChecker;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['check', EventPriorities::PRE_VALIDATE]
        ];
    }

    public function check(ViewEvent $event): void
    {
        $post = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($post instanceof Post &&
            !in_array($method, $this->methodNotAllowed, true)
        ) {
            $this->postAuthorizationChecker->check($post, $method);
        }
    }
}
