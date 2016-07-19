<?php

namespace Wame\UserModule\Forms;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Forms\BaseFormContainer;
use Wame\UserModule\Entities\UserEntity;


interface IEmailFormContainerFactory
{
	/** @return EmailFormContainer */
	public function create();
}


class EmailFormContainer extends BaseFormContainer
{
    public function configure() 
	{
		$form = $this->getForm();
		
		$form->addText('email', _('Email'))
				->setType('email')
				->setRequired(_('Please enter your email'))
				->addRule(Form::FILLED, _('Enter email'))
				->addRule(Form::EMAIL, _('Wrong format email'));
    }


	public function setDefaultValues($object)
	{
		$form = $this->getForm();
		
		$form['email']->setDefaultValue($object->userEntity->email);
	}

  
    /**
     * Create
     * 
     * @param \Nette\Application\UI\Form $form
     * @param array $values
     * @param \Nette\Application\UI\Presenter $presenter
     */
    public function create($form, $values, $presenter)
    {
        $userEntity = $presenter->getStatus()->get('userEntity');

        if (!$userEntity) {
            $userEntity = new UserEntity();
        }

		$userEntity->setEmail($values['email']);

        $presenter->getStatus()->set('userEntity', $userEntity);
    }

}