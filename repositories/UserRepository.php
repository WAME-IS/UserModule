<?php

namespace Wame\UserModule\Repositories;

use Nette\Utils\Random;
use Nette\Utils\Strings;
use Wame\Core\Repositories\BaseRepository;
use Wame\UserModule\Entities\UserEntity;
use Wame\Core\Exception\RepositoryException;


class UserRepository extends BaseRepository
{
	const STATUS_BLOCKED = 0;
	const STATUS_ACTIVE = 1;
	const STATUS_VERIFY_EMAIL = 2;
	const STATUS_RESET_PASSWORD = 3;


    /**
     * Event called when password reset
     *
     * @var callable[]
     */
    public $onPasswordReset = [];

    /**
     * Event called when email is confirmed
     *
     * @var callable[]
     */
    public $onConfirm = [];


	public function __construct()
    {
		parent::__construct(UserEntity::class);
	}


	/**
	 * Create user
	 *
	 * @param UserEntity $userEntity
	 * @return UserEntity
	 * @throws RepositoryException
	 */
	public function create($userEntity)
	{
		$this->emailExists($userEntity->getEmail());

        if (method_exists($userEntity, 'getNick') && $userEntity->getNick() != '') {
            $this->nickExists($userEntity->getNick());
        }

		$this->entityManager->persist($userEntity);
		$this->entityManager->persist($userEntity->info);

		return $userEntity;
	}


	/**
	 * Update user
	 *
	 * @param UserEntity $userEntity
	 * @return UserEntity
	 */
	public function update($userEntity)
	{
		$this->emailExists($userEntity->getEmail(), null, $userEntity->getId());

        dump(method_exists($userEntity, 'getNick'));
        exit;

        if (method_exists($userEntity, 'getNick') && $userEntity->getNick() != '') {
            $this->nickExists($userEntity->getEmail(), $userEntity->getId());
        }

		return $userEntity;
	}


	/**
	 * Delete user by criteria
	 *
	 * @param array $criteria
	 * @param int $status
	 */
	public function delete($criteria = [], $status = self::STATUS_BLOCKED)
	{
		$userEntity = $this->findOneBy($criteria);
		$userEntity->status = $status;
	}


	/**
	 * Return password and if not exists so generate
	 *
	 * @param array $values
	 * @return string
	 * @throws RepositoryException
	 */
	public function getPassword($values = [])
	{
		if (array_key_exists('password', $values)) {
			if ($values['password'] && $values['password'] == $values['password_repeat']) {
				$password = $values['password'];
			} else {
				throw new RepositoryException(_('Passwords must be the same.'));
			}
		} else {
			$password = Strings::random();
		}

		return $password;
	}


	/**
	 * Reset password
	 * password set on null and change status
	 *
	 * @param array $criteria
	 * @return UserEntity
	 * @throws RepositoryException
	 */
	public function resetPassword($criteria)
	{
		$userEntity = $this->get($criteria);

		if (!$userEntity) {
			throw new RepositoryException(_('The user of this data not found.'));
		}

		if ($userEntity->status == self::STATUS_BLOCKED) {
			throw new RepositoryException(_('This user account is blocked.'));
		}

        $this->onPasswordReset($userEntity);

//		$userEntity->password = null;
//		$userEntity->status = self::STATUS_RESET_PASSWORD;

		return $userEntity;
	}


	/**
	 * Change password
	 *
	 * @param UserEntity $userEntity
	 * @param string $password
	 * @return UserEntity
	 * @throws RepositoryException
	 */
	public function changePassword($userEntity, $password)
	{
		$userEntity->password = $password;
		$userEntity->status = self::STATUS_ACTIVE;

		return $userEntity;
	}


	/**
	 * Generate token
	 *
	 * @param int $length
	 * @return string
	 */
	public function generateToken($length = 10)
	{
		return Random::generate($length);
	}


	/**
	 * Check email is exists
	 *
	 * @param string $email
	 * @param mixed $role
	 * @param mixed $without without user ids
	 * @return mixed
     * @throws RepositoryException
	 */
	public function emailExists($email, $role = null, $without = null)
	{
		$by = ['email' => $email];

		if ($role) {
			if (!is_array($role)) {
				$role = [$role];
			}

			$by['role'] = $role;
		}

		if ($without) {
			if (!is_array($without)) {
				$without = [$without];
			}

			$by['id !='] = $without;
		}

		$check = $this->countBy($by);

		if ($check == 0) {
			return null;
		} else {
			throw new RepositoryException(_('The user with this email already exists.'));
		}
	}


    /**
     * Check nick is exists
     *
     * @param string $nick
     * @param mixed $without without user ids
     * @return mixed
     * @throws RepositoryException
     */
    public function nickExists($nick, $without = null)
    {
        $by = ['nick' => $nick, 'status !=' => self::STATUS_BLOCKED];

        if ($without) {
            if (!is_array($without)) {
                $without = [$without];
            }

            $by['id !='] = $without;
        }

        $check = $this->countBy($by);

		if ($check == 0) {
			return null;
		} else {
			throw new RepositoryException(_('The user with this nick already exists.'));
		}
    }


    /** api *******************************************************************/

	/**
	 * @api {get} /user-search/ Search users
	 * @param array $columns	columns
	 * @param string $phrase	phrase
	 * @param string $select	select
	 */
	public function findLike($columns = [], $phrase = null, $select = '*')
	{
		$search = $this->entityManager->createQueryBuilder()
				->select($select)
				->from(UserEntity::class, 'u')
//				->leftJoin(\Wame\UserModule\Entities\UserInfoEntity::class, 'i', \Doctrine\ORM\Query\Expr\Join::WITH, 'u.id = i.user')
				->andWhere('u.status = :status')
				->setParameter('status', self::STATUS_ACTIVE);

		foreach ($columns as $column) {
			$search->andWhere($column . ' LIKE :phrase');
		}

		$search->setParameter('phrase', '%' . $phrase . '%');

		return $search->getQuery()->getResult();
	}


	/**
	 * @api {get} /user/ User
	 * @param type $criteria
	 * @param type $orderBy
	 * @param type $limit
	 * @param type $offset
	 */
	public function find($criteria = array(), $orderBy = array(), $limit = null, $offset = null)
    {
		return parent::find($criteria, $orderBy, $limit, $offset);
	}


    /**
	 * @api {get} /user/:id Get user by id
	 * @param int $id
	 */
	public function getUserById($id)
    {
		return $this->get(['id' => $id]);
	}

}
