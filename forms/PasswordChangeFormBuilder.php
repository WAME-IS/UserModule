<?php

namespace Wame\UserModule\Forms;

use Kdyby\Doctrine\EntityManager;
use Nette\Security\User;
use Wame\DynamicObject\Forms\BaseForm;
use Wame\DynamicObject\Forms\BaseFormBuilder;
use Wame\UserModule\Repositories\UserRepository;


class PasswordChangeFormBuilder extends BaseFormBuilder
{
    /** @var User */
    private $user;

    /** @var EntityManager */
    private $entityManager;

    /** @var UserRepository */
    private $userRepository;


    public function __construct(
        User $user,
        EntityManager $entityManager,
        UserRepository $userRepository
    ) {
        parent::__construct();

        $this->user = $user;
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }


    public function submit(BaseForm $form, array $values)
    {
        parent::submit($form, $values);

        $presenter = $form->getPresenter();

        try {
            $password = $this->userRepository->getPassword($values);
            $this->userRepository->changePassword($this->user->getEntity(), $password);

            $this->entityManager->flush();

            $presenter->flashMessage(_('Password successfully changed.'), 'success');
        } catch (\Exception $e) {
            if ($e instanceof \Nette\Application\AbortException) {
                throw $e;
            }

            $form->addError($e->getMessage());
            $this->entityManager->clear();
        }
    }

}
