<?php

namespace App\UserModule\Presenters;

use App\Core\Presenters\BasePresenter;
use Wame\UserModule\Repositories\UserRepository;

class UserPresenter extends BasePresenter
{
	/** @var UserRepository @inject */
	public $userRepository;
	
	
	public function renderDefault()
	{
		$this->template->siteTitle = _('Users');
	}

}
