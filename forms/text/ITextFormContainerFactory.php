<?php

namespace Wame\UserModule\Forms;

interface ITextFormContainerFactory
{
	/** @return TextFormContainer */
	public function create();
	
}