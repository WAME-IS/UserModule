<?php

namespace Wame\UserModule\Forms\Settings;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Forms\BaseFormContainer;
use Nette\Security\User;

interface IPasswordFormContainerFactory
{
	/** @return PasswordFormContainer */
	public function create();
}


class PasswordFormContainer extends BaseFormContainer
{
    /** @var User */
    private $user;
    
    
    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
    }
    
    public function configure() 
	{
		$form = $this->getForm();
        
		$form->addPassword('password', _('Password'))
				->setType('password');
        
        $form->addPassword('password_repeat', _('Password repeat'))
				->setType('password')
                ->setRequired(false)
				->addRule(Form::EQUAL, _('Passwords must be the same'), $form['password']);
    }
    
    
    /** @inheritdoc */
    public function create($form, $values, $presenter)
    {
        if($values['password'] && $values['password_repeat']) {
            $userEntity = $this->user->getEntity();
            $userEntity->setPassword($values['password']);
        }
    }

}