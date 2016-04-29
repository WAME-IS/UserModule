<?php

namespace App\UserModule\Presenters;

class PasswordPresenter extends \App\Core\Presenters\BasePresenter
{
	public function renderForgot()
	{
		$this->template->siteTitle = _('Reset password');
	}

}
