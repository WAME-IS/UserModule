<?php

namespace Wame\UserModule\Forms;

use Nette\DI\Container;
use Nette\Security\AuthenticationException;
use Wame\DynamicObject\Forms\BaseForm;
use Wame\DynamicObject\Forms\BaseFormBuilder;
use Wame\Security\User;

class UserSignInFormBuilder extends BaseFormBuilder
{
    /** @var User */
    protected $user;

    /** @var array */
    private $loginExpiration;


    public function __construct(Container $container, User $user)
    {
        parent::__construct();

        $this->user = $user;
        $this->loginExpiration = $container->parameters['user']['loginExpiration'];
    }


    public function submit(BaseForm $form, array $values)
    {
        parent::submit($form, $values);

        if ($values['RememberContainer']['remember']) {
            $this->user->setExpiration($this->loginExpiration['remember'], false);
        } else {
            $this->user->setExpiration($this->loginExpiration['forget'], true);
        }

        try {
            $this->user->login($values['EmailContainer']['email'], $values['PasswordContainer']['password']);
        } catch (AuthenticationException $e) {
            $form->addError($e->getMessage());
        }
    }

}