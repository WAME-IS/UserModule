<?php

namespace Wame\UserModule\Forms;

use Kdyby\Doctrine\EntityManager;
use Nette\Application\LinkGenerator;
use Wame\DynamicObject\Forms\BaseForm;
use Wame\DynamicObject\Forms\BaseFormBuilder;
use Wame\UserModule\Repositories\TokenRepository;
use Wame\UserModule\Repositories\UserRepository;
use Wame\Utils\HttpRequest;


class PasswordNewFormBuilder extends BaseFormBuilder
{
    /** @var LinkGenerator */
    private $linkGenerator;

    /** @var EntityManager */
    private $entityManager;

    /** @var TokenRepository */
    protected $tokenRepository;

    /** @var UserRepository */
    protected $userRepository;

    /** @var HttpRequest */
    protected $httpRequest;


    public function __construct(
        LinkGenerator $linkGenerator,
        EntityManager $entityManager,
        TokenRepository $tokenRepository,
        UserRepository $userRepository,
        HttpRequest $httpRequest
    ) {
        parent::__construct();

        $this->linkGenerator = $linkGenerator;
        $this->entityManager = $entityManager;
        $this->tokenRepository = $tokenRepository;
        $this->userRepository = $userRepository;
        $this->httpRequest = $httpRequest;
    }


    public function build($domain = null)
    {
        $form =  parent::build($domain);

        $form->setAction($this->linkGenerator->link('User:Password:new', $this->httpRequest->getParameters()));

        return $form;
    }


    public function submit(BaseForm $form, array $values)
    {
        parent::submit($form, $values);

        $presenter = $form->getPresenter();

        try {
            $email = $presenter->getParameter('email');
            $hash = $presenter->getParameter('hash');

            $tokenEntity = $this->tokenRepository->getToken($hash, $email);

            if (!$tokenEntity) {
                throw new \Exception(_('This token does not exist.'));
            }

            $userEntity = $tokenEntity->getUser();

            $this->tokenRepository->create($userEntity);

            $password = $this->userRepository->getPassword($values);
            $this->userRepository->changePassword($userEntity, $password);

            $this->entityManager->flush();

            $presenter->flashMessage(_('Password successfully changed, you can log in now.'), 'success');

            $presenter->redirect(':User:Sign:in', ['id' => null]);
        } catch (\Exception $e) {
            if ($e instanceof \Nette\Application\AbortException) {
                throw $e;
            }

            $form->addError($e->getMessage());
            $this->entityManager->clear();
        }
    }

}
