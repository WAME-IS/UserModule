<?php

namespace Wame\UserModule\Forms;

use Nette\Application\UI\Form;
use Wame\DynamicObject\Forms\BaseFormContainer;

interface IEmailFormContainerFactory
{
	/** @return EmailFormContainer */
	public function create();
}


class EmailFormContainer extends BaseFormContainer
{	
//	/**
//	 * Container callback
//	 * 
//	 * @param Form $object
//	 */
//    public function attached($object) 
//	{
//        parent::attached($object);
//
//        if ($object instanceof Form) {
//            $object->onSuccess[] = function (Form $form) {
//                $path = $this->lookupPath(Form::class);
////                dump($form->getValues()->$path);
//            };
//        }
//    }

	
    public function render() 
	{
        $this->template->_form = $this->getForm();
        $this->template->render(__DIR__ . '/default.latte');
    }

	
    public function configure() 
	{
		$form = $this->getForm();
		
		$form->addGroup(_('Login data'));

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
	
}