<?php

namespace Wame\UserModule\Forms;

use Wame\DynamicObject\Forms\BaseForm;
use Wame\DynamicObject\Forms\EntityFormBuilder;
use Wame\UserModule\Entities\UserEntity;
use Wame\UserModule\Repositories\TokenRepository;
use Wame\Utils\Date;


class UserSignUpFormBuilder extends EntityFormBuilder
{
    /** @var TokenRepository */
    private $tokenRepository;


    public function __construct(TokenRepository $tokenRepository)
    {
        parent::__construct();

        $this->tokenRepository = $tokenRepository;
    }


    /** {@inheritDoc} */
    public function submit(BaseForm $form, array $values)
    {
        $entity = $form->getEntity();

        $entity = $this->create($form, $values);

        if ($this->persist) {
            $this->getRepository()->create($entity);
        }

        $this->getRepository()->onCreate($form, $values, $entity);

        $form->getRepository()->entityManager->flush();
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
