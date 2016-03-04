<?php

namespace Wame\UserModule\Repositories;

class UserInfoRepository extends \Wame\Core\Repositories\BaseRepository
{
	const TABLE_NAME = 'user_info';
	
	public function __construct(\Nette\DI\Container $container) 
	{
		parent::__construct($container, self::TABLE_NAME);
	}
	
}