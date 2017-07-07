<?php

namespace Wame\UserModule\Forms;

use Wame\DynamicObject\Forms\EntityFormBuilder;
use Wame\UserModule\Entities\UserEntity;
use Wame\Utils\Date;
use Wame\Utils\Security;

class UserSignUpFormBuilder extends EntityFormBuilder
{
    protected function create($form, $values)
    {
        /** @var UserEntity $entity */
        $entity = parent::create($form, $values);

        $entity->setRegisterDate(Date::toDateTime(Date::NOW));
        $entity->setLang($form->getPresenter()->lang);
        $entity->setToken(Security::generateToken());

        return $entity;
    }

}