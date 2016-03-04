<?php

namespace Wame\UserModule\Repositories;

class UserRepository extends \Wame\Core\Repositories\BaseRepository
{
	const TABLE_NAME = 'user';
	
	const STATUS_BLOCKED = 0;
	const STATUS_ACTIVE = 1;
	const STATUS_VERIFY_PHONE = 2;
	const STATUS_VERIFY_EMAIL = 3;
	
	public function __construct(\Nette\DI\Container $container) 
	{
		parent::__construct($container, self::TABLE_NAME);
	}
	
}