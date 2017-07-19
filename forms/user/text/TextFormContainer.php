<?php

namespace Wame\UserModule\Forms;

use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Wame\DynamicObject\Forms\BaseFormContainer;
use Wame\UserModule\Entities\UserEntity;


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

        $form['text']->setDefaultValue($object->userEntity->getText());
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

        $userEntity->setText($values['text']);

        $presenter->getStatus()->set(UserEntity::class, $userEntity);
    }

}
