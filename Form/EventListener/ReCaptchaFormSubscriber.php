<?php

namespace Sfue\ReCaptchaBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ReCaptchaFormListener
 * @package Sfue\ReCaptchaBundle\EventListener
 */
class ReCaptchaFormSubscriber implements EventSubscriberInterface
{
    /** @var Request */
    protected $request;

    /**
     * ReCaptchaFormListener constructor.
     * @param Request $request
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array {
        return array(
            FormEvents::PRE_SUBMIT => 'onPreSubmit'
        );
    }

    /**
     * @param FormEvent $event
     */
    public function onPreSubmit(FormEvent $event) {
        if(!\is_null($this->request->request->get('g-recaptcha-response'))) {
            // per default, the recaptcha response is in the g-recaptcha-response request field
            // not in in the form itself
            // set the google recaptcha response to the form to validate against the google API
            $event->setData($this->request->request->get('g-recaptcha-response'));

            $this->request->request->remove('g-recaptcha-response');
        }
    }
}
