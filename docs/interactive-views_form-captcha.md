# Captcha

There two captcha plugins for ATK4.

## x_captcha
[github repo](https://github.com/rvadym/x_captcha)

Don't forget to clone addon to your project first.

    $f = $page->add('Form');
    $f->addField('Line','captcha')->add('x_captcha/Controller_Captcha');
    $f->addSubmit('Verify captcha');
    $f->onSubmit(function($f) {
        if ( $f->get('captcha') == mb_strtolower($f->getElement('captcha')->captcha->recallCaptcha()) ) {
            $f->js()->univ()->alert('Good captcha')->execute();
        } else {
            $f->js()->univ()->alert('Bad captcha')->execute();
        }
    });


## reCAPTCHA (from Google)
[github repo](https://github.com/rvadym/x_recaptcha)

Don't forget to clone addon to your project first. <br>
Use <strong>Recaptcha.reload()</strong> to reload captcha with no page reload.

    $f = $page->add('Form');
    $f->add('x_recaptcha/Controller_ReCaptcha','captcha');
    $f->addSubmit('Verify captcha');
    $f->onSubmit(function($f) {
        if ($f->recaptcha->isCaptchaOk) {
            $f->js(null,'Recaptcha.reload()')->univ()->alert('Good captcha')->execute();
        } else {
            $f->js(null,'Recaptcha.reload()')->univ()->alert('Bad captcha')->execute();
        }
    });