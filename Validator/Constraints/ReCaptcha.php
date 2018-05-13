<?php

namespace Sfue\ReCaptchaBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class ReCaptcha
 * @package Sfue\ReCaptchaBundle\Validator\Constraints
 */
class ReCaptcha extends Constraint
{
    /** @var string */
    public $secretMissing = 'sfue_re_captcha.secret_missing';

    /** @var string */
    public $secretInvalid = 'sfue_re_captcha.secret_invalid';

    /** @var string */
    public $reCaptchaEmpty = 'sfue_re_captcha.re_captcha_empty';

    /** @var string */
    public $reCaptchaInvalid = 'sfue_re_captcha.re_captcha_invalid';

    /**
     * @param string $code
     * @return string
     */
    public function getMessageByCode(string $code): string {
        switch($code) {
            case 'missing-input-secret':
                $message = $this->secretMissing;
                break;
            case 'invalid-input-secret':
                $message = $this->secretInvalid;
                break;
            case 'missing-input-response':
                $message = $this->reCaptchaEmpty;
                break;
            case 'invalid-input-response':
            case 'bad-request':
            default:
                $message = $this->reCaptchaInvalid;
                break;
        }

        return $message;
    }
}
