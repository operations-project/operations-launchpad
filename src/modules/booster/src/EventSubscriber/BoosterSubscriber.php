<?php

declare(strict_types=1);

namespace Drupal\booster\EventSubscriber;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Database\Database;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * @todo Add description for this subscriber.
 */
final class BoosterSubscriber implements EventSubscriberInterface {

  /**
   * Constructs a BoosterSubscriber object.
   */
  public function __construct(
    private readonly ConfigFactoryInterface $configFactory,
  ) {}


  public function checkSiteDatabase(RequestEvent $event) {


    if ($event->getRequest()->getHost()) {
      //$event->setResponse(new RedirectResponse('http://example.com/'));

      Database::setActiveConnection($event->getRequest()->getHost());
//      \Drupal::messenger()->addStatus('Loading site ' . $event->getRequest()->getHost());

    }


  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('checkSiteDatabase');
    return $events;
  }


}
