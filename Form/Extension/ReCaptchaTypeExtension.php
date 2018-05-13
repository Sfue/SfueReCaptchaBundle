<?php

namespace Sfue\ReCaptchaBundle\Form\Extension;

use Sfue\ReCaptchaBundle\Form\EventListener\ReCaptchaFormSubscriber;
use Sfue\ReCaptchaBundle\Form\Type\ReCaptchaType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class ReCaptchaTypeExtension
 * @package Sfue\ReCaptchaBundle\Form\Extension
 */
class ReCaptchaTypeExtension extends AbstractTypeExtension
{
    /** @var RequestStack */
    protected $requestStack;

    /**
     * ReCaptchaTypeExtension constructor.
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack) {
        $this->requestStack = $requestStack;
    }

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->addEventSubscriber(new ReCaptchaFormSubscriber($this->requestStack->getCurrentRequest()));
    }

    /**
     * @inheritdoc
     */
    public function getExtendedType(): string {
        return ReCaptchaType::class;
    }
}