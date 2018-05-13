<?php

namespace Sfue\ReCaptchaBundle\Form\Type;

use Sfue\ReCaptchaBundle\Validator\Constraints\ReCaptcha;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ReCaptchaType
 * @package Sfue\ReCaptchaBundle\Form\Type
 */
class ReCaptchaType extends AbstractType {

    /** @var string */
    private $siteKey;

    /**
     * ReCaptchaType constructor.
     * @param $siteKey
     */
    public function __construct(string $siteKey) {
        $this->siteKey = $siteKey;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults(array(
            'mapped'      => false,
            'compound'    => false,
            'translation_domain' => 'validators',
            'attr' => array(
                'data-sitekey' => $this->siteKey,
                'class'        => 'g-recaptcha'
            ),
            'constraints' => [
                new ReCaptcha()
            ]
        ));
    }

    /**
     * @return string
     */
    public function getParent(): string {
        return TextType::class;
    }

    /**
     * @return string
     */
    public function getBlockPrefix(): string {
        return 'recaptcha';
    }
}
