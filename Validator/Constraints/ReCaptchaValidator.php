<?php

namespace Sfue\ReCaptchaBundle\Validator\Constraints;

use ReCaptcha\Response;
use ReCaptcha\ReCaptcha;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class ReCaptchaValidator
 * @package Sfue\ReCaptchaBundle\Validator\Constraints
 */
class ReCaptchaValidator extends ConstraintValidator
{
    /** @var string */
    protected $googleSecret;

    /** @var \Symfony\Component\HttpFoundation\Request  */
    protected $request;

    /**
     * ReCaptchaValidator constructor.
     * @param string $secret
     * @param RequestStack $requestStack
     */
    public function __construct(string $secret, RequestStack $requestStack) {
        $this->googleSecret = $secret;
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint) {
        if(empty($value)) {
            $this->context->buildViolation($constraint->getMessageByCode('missing-input-response'))->addViolation();
        } else {
            $googleReCaptcha = new ReCaptcha($this->googleSecret);
            /** @var Response $reCaptchaResponse */
            $reCaptchaResponse = $googleReCaptcha->verify($value, $this->request->getClientIp());

            if(!$reCaptchaResponse->isSuccess()) {
                foreach($reCaptchaResponse->getErrorCodes() as $code) {
                    $this->context->buildViolation($constraint->getMessageByCode($code))->addViolation();
                }
            }
        }
    }
}

