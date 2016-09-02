<?php

namespace Wame\UserModule\Forms;

use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Wame\DynamicObject\Forms\BaseFormContainer;
use Wame\UserModule\Entities\UserEntity;


interface INickFormContainerFactory
{
	/** @return NickFormContainer */
	public function create();
}


class NickFormContainer extends BaseFormContainer
{
    public function configure() 
	{
		$form = $this->getForm();

		$form->addGroup(_('Login data'));

		$form->addText('nick', _('Nick'))
				->setRequired(_('Please enter nick'));
    }


	public function setDefaultValues($object)
	{
		$form = $this->getForm();
		
		$form['nick']->setDefaultValue($object->userEntity->nick);
	}

    
    /**
     * Create
     * 
     * @param Form $form
     * @param array $values
     * @param Presenter $presenter
     */
    public function create($form, $values, $presenter)
    {
        $userEntity = $presenter->getStatus()->get(UserEntity::class);

        if (!$userEntity) {
            $userEntity = new UserEntity();
        }

        $userEntity->setNick($values['nick']);

        $presenter->getStatus()->set(UserEntity::class, $userEntity);
    }

}