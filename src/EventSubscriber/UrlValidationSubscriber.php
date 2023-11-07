<?php

namespace App\EventSubscriber;

use App\Repository\IndexPoleRepository;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UrlValidationSubscriber implements EventSubscriberInterface
{
    private $indexPoleRepository;
    private $router;

    public function __construct(IndexPoleRepository $indexPoleRepository, RouterInterface $router)
    {
        $this->indexPoleRepository = $indexPoleRepository;
        $this->router = $router;
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $controller = $event->getController();
        $request = $event->getRequest();

        //Fetch current URL
        $checkUrl = $request->attributes->get('url');
        //Use the function "findByUrl" for check the current URL exist in database
        $urlInDataBase = $this->indexPoleRepository->findByUrl($checkUrl);
        
        //Redirect the user on ErrorPage, if the URL doesn't exist
        if ($checkUrl !== $urlInDataBase["urlIndex"]) {
            $response = new RedirectResponse('/error_url');
            $event->setController(function () use ($response) {
                return $response;
            });
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}