<?php


namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Post;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class CurrentUserForPostsSubscriber implements EventSubscriberInterface
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['currentUserForArticles', EventPriorities::PRE_VALIDATE],
        ];
    }

    public function currentUserForArticles(ViewEvent $event): void
    {
        $post = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($post instanceof Post && Request::METHOD_POST === $method) {
            $post->setAuthor($this->security->getUser());
        }
    }
}
