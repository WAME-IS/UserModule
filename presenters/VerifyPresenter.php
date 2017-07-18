<?php

namespace App\UserModule\Presenters;

use Wame\UserModule\Repositories\TokenRepository;
use Wame\UserModule\Repositories\UserRepository;


class VerifyPresenter extends \App\Core\Presenters\BasePresenter
{
    /** @var TokenRepository @inject */
    public $tokenRepository;

    /** @var UserRepository @inject */
    public $userRepository;

    
    /** actions ***************************************************************/
    
    public function actionDefault()
    {
        $error = false;
        $email = $this->getParameter('email');
        $hash = $this->getParameter('hash');

        $tokenEntity = $this->tokenRepository->getByToken($hash);
        $userEntity = $this->userRepository->get(['id' => $tokenEntity->getUser()->getId(), 'email' => $email, 'status' => UserRepository::STATUS_VERIFY_EMAIL]);

        if ($email & $hash) {
            if($userEntity) {
                $userEntity->setStatus(UserRepository::STATUS_ACTIVE);
            } else {
                $error = true;
            }
        } else {
            $error = true;
        }
        
        if (!$error) {
            $this->tokenRepository->create($userEntity);

            $this->flashMessage(_('Your account has been activated, please sign in.'), 'info');
            $this->userRepository->onConfirm($userEntity);
        } else {
            $this->flashMessage(_('Invalid approach, please use the link that has been send to your email.'), 'danger');
        }
        
        $this->redirect(':User:Sign:in');
    }

}
