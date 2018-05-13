# SfueReCaptchaBundle

## Installation

Install the bundle via composer
```bash
$ composer require sfue/re-captcha-bundle
```

Add the Bundle to your AppKernel
```php
// app/AppKernel.php

<?php

public function registerBundles()
{
    $bundles = array(
        // ...
        new new Sfue\ReCaptchaBundle\SfueReCaptchaBundle(),
    );
}
```

Add the bundles form theme to your twig configuration
```yaml
sfue_re_captcha:
    site_key: 'your Google reCAPTCHA site key'
    secret: 'your Google reCAPTCHA secret'
```

Add the bundles form theme to your twig configuration
```yaml
# Twig Configuration
twig:
    form_themes:
        - 'SfueReCaptchaBundle:Form:fields.html.twig'
```

Use the ReCaptchaType in any form you want to have a reCAPTCHA field
```php

public function buildForm(FormBuilderInterface $builder, array $options) {
	$builder
		// ...
		->add('recaptcha', ReCaptchaType::class)
	;
}
```