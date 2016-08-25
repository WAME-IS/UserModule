<?php

namespace Wame\UserModule\Forms\Settings;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Forms\BaseFormContainer;
use Nette\Security\User;

interface INickFormContainerFactory
{
	/** @return NickFormContainer */
	public function create();
}


class NickFormContainer extends BaseFormContainer
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
        
		$form->addPassword('nick', _('Nick'))
				->setType('nick')
                ->setDisabled();
    }
    
    public function setDefaultValues($object)
	{
		$form = $this->getForm();
		
		$form['nick']->setDefaultValue($object->userEntity->nick);
	}

}