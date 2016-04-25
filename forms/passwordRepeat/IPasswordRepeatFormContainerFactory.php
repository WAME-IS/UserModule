<?php

namespace Wame\UserModule\Forms;

interface IPasswordRepeatFormContainerFactory
{
	/** @return PasswordRepeatFormContainer */
	public function create();
	
}