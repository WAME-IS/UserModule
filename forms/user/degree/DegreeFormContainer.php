<?php

namespace Wame\UserModule\Forms;

use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Wame\DynamicObject\Forms\BaseFormContainer;
use Wame\UserModule\Entities\UserInfoEntity;


interface IDegreeFormContainerFactory
{
	/** @return DegreeFormContainer */
	public function create();
}


class DegreeFormContainer extends BaseFormContainer
{
    public function configure() 
	{
		$form = $this->getForm();
		
		$form->addGroup(_('Contact details'));

		$form->addText('degree', _('Degree'));
    }


	public function setDefaultValues($object)
	{
		$form = $this->getForm();

		$form['degree']->setDefaultValue($object->userEntity->info->degree);
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
        $userInfoEntity = $presenter->getStatus()->get(UserInfoEntity::class);

        if (!$userInfoEntity) {
            $userInfoEntity = new UserInfoEntity();
        }

        $userInfoEntity->setDegree($values['degree']);

        $presenter->getStatus()->set(UserInfoEntity::class, $userInfoEntity);
    }

}