<?php

namespace Wame\UserModule\Forms;

use Wame\Utils\Date;
use Wame\DynamicObject\Forms\BaseFormContainer;
use Wame\UserModule\Entities\UserInfoEntity;


interface IBirthdateFormContainerFactory
{
	/** @return BirthdateFormContainer */
	public function create();	
}


class BirthdateFormContainer extends BaseFormContainer
{
    public function configure() 
	{
		$form = $this->getForm();
		
		$form->addGroup(_('Other details'));

		$form->addText('birthdate', _('Birthdate'));
    }


	public function setDefaultValues($object)
	{
		$form = $this->getForm();

		if ($object->userEntity->info->birthdate) {
			$form['birthdate']->setDefaultValue(Date::toString($object->userEntity->info->birthdate, 'd.m.Y'));
		}
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
        $userInfoEntity = $presenter->getStatus()->get('userInfoEntity');

        if (!$userInfoEntity) {
            $userInfoEntity = new UserInfoEntity();
        }
        
        if ($values['birthdate']) {
			$userInfoEntity->setBirthdate(Date::toDateTime($values['birthdate'], 'Y-m-d'));
		} else {
			$userInfoEntity->setBirthdate(null);
		}

        $presenter->getStatus()->set('userInfoEntity', $userInfoEntity);
    }

}