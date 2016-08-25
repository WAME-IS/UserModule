<?php

namespace Wame\UserModule\Forms\Settings;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Forms\BaseFormContainer;
use Nette\Security\User;

interface IEmailFormContainerFactory
{
	/** @return EmailFormContainer */
	public function create();
}

class EmailFormContainer extends BaseFormContainer
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
        
		$form->addPassword('email', _('Email'))
				->setType('email');
    }
    
    
    public function setDefaultValues($object)
	{
		$form = $this->getForm();
		
		$form['email']->setDefaultValue($object->userEntity->email);
	}
    
    
    /** {@inheritDoc} */
    public function create($form, $values, $presenter)
    {
        if($values['email']) {
            $userEntity = $this->user->getEntity();
            $userEntity->setEmail($values['email']);
        }
    }
    
    /** {@inheritDoc} */
    public function update($form, $values, $presenter)
    {
        if($values['email']) {
            $userEntity = $this->user->getEntity();
            $userEntity->setEmail($values['email']);
        }
    }

}