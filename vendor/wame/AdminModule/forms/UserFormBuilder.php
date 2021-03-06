<?php

namespace Wame\UserModule\Vendor\Wame\AdminModule\Forms;

use Wame\DynamicObject\Forms\BaseForm;
use Wame\DynamicObject\Forms\EntityFormBuilder;
use Wame\UserModule\Entities\UserEntity;
use Wame\UserModule\Repositories\TokenRepository;
use Wame\Utils\Date;


class UserFormBuilder extends EntityFormBuilder
{
    /** @var TokenRepository */
    private $tokenRepository;


    public function __construct(TokenRepository $tokenRepository)
    {
        parent::__construct();

        $this->tokenRepository = $tokenRepository;
    }


    /** {@inheritDoc} */
    protected function create($form, $values)
    {
        /** @var UserEntity $entity */
        $entity = parent::create($form, $values);

        $entity->setRegisterDate(Date::toDateTime(Date::NOW));
        $entity->setLang($form->getPresenter()->lang);
        $entity->setToken($this->tokenRepository->create($entity));

        return $entity;
    }

}
