<?php

namespace Wame\UserModule\Forms;

use Nette\DI\Container;
use Nette\Security\AuthenticationException;
use Wame\DynamicObject\Forms\BaseForm;
use Wame\DynamicObject\Forms\BaseFormBuilder;
use Wame\Security\User;
use Wame\UserModule\Repositories\UserRepository;

class PasswordForgotFormBuilder extends BaseFormBuilder
{
    /** @var UserRepository */
    protected $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();

        $this->userRepository = $userRepository;
    }


    public function submit(BaseForm $form, array $values)
    {
        parent::submit($form, $values);

        $this->userRepository->resetPassword(['email' => $values['EmailContainer']['email']]);

        $form->getPresenter()->flashMessage(_('We sent you a link to your email where you can change your password.'), 'info');
        $form->getPresenter()->redirect(':User:Password:submit', ['id' => null]);
    }

}