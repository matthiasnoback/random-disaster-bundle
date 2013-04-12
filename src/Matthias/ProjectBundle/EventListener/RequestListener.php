<?php

namespace Matthias\ProjectBundle\EventListener;

use Matthias\ProjectBundle\Generator\GeneratorInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class RequestListener implements EventSubscriberInterface
{
    private $startAt;
    private $deadline;
    private $generator;

    public static function getSubscribedEvents()
    {
        return array(
            // be the first to know
            KernelEvents::REQUEST => array('onRequest', 100000)
        );
    }

    public function __construct($startAt, $deadline, GeneratorInterface $generator)
    {
        $this->startAt = strtotime($startAt);
        $this->deadline = strtotime($deadline);
        $this->generator = $generator;
    }

    public function onRequest(GetResponseEvent $event)
    {
        $now = time();
        if ($this->deadline < $now) {
            // everything should appear to work now
            return;
        }

        $currentProbability = $this->calculateCurrentProbabilityForDisaster($now);

        $randomChance = mt_rand(0, 100) / 100;
        if ($randomChance <= $currentProbability) {
            $disaster = $this->generator->generate();

            $disaster();
        }
    }

    private function calculateCurrentProbabilityForDisaster()
    {
        $totalTime = $this->deadline - $this->startAt;
        $timeLeft = $this->deadline - time();

        return $timeLeft / $totalTime;
    }
}
