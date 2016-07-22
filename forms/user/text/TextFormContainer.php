<?php

namespace Wame\UserModule\Forms;

use Wame\DynamicObject\Forms\BaseFormContainer;
use Wame\UserModule\Entities\UserInfoEntity;


interface ITextFormContainerFactory
{
	/** @return TextFormContainer */
	public function create();
}


class TextFormContainer extends BaseFormContainer
{
    public function configure() 
	{
		$form = $this->getForm();
		
		$form->addTextArea('text', _('About me'));
    }


	public function setDefaultValues($object)
	{
		$form = $this->getForm();

		$form['text']->setDefaultValue($object->userEntity->info->text);
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

        $userInfoEntity->setText($values['text']);

        $presenter->getStatus()->set('userInfoEntity', $userInfoEntity);
    }

}