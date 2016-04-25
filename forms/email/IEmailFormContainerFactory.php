<?php

namespace Wame\UserModule\Forms;

interface IEmailFormContainerFactory
{
	/** @return EmailFormContainer */
	public function create();
	
}