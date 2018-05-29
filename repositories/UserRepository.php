<?php

namespace Wame\UserModule\Repositories;

use Nette\Utils\Random;
use Wame\Core\Repositories\BaseRepository;
use Wame\UserModule\Entities\UserEntity;
use Wame\Core\Exception\RepositoryException;


class UserRepository extends BaseRepository
{
	const STATUS_BLOCKED = 0;
	const STATUS_ACTIVE = 1;
	const STATUS_VERIFY_EMAIL = 2;

    const GENDER_WOMAN = 0;
    const GENDER_MAN = 1;


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
	    try {
            $this->emailExists($userEntity->getEmail());
        } catch (\Exception $e) {
            $this->entityManager->clear();
            throw new \Exception($e->getMessage());
        }

        if (method_exists($userEntity, 'getNick') && $userEntity->getNick() != '') {
            try {
                $this->nickExists($userEntity->getNick());
            } catch (\Exception $e) {
                $this->entityManager->clear();
                throw new \Exception($e->getMessage());
            }
        }

        $this->entityManager->persist($userEntity);

        $this->entityManager->flush();

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

        if (method_exists($userEntity, 'getNick') && $userEntity->getNick() != '') {
            $this->nickExists($userEntity->getNick(), $userEntity->getId());
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
		if (isset($values['PasswordContainer']['password'])) {
			if ($values['PasswordContainer']['password'] && $values['PasswordContainer']['password'] == $values['PasswordRepeatContainer']['passwordRepeat']) {
				$password = $values['PasswordContainer']['password'];
			} else {
				throw new RepositoryException(_('Passwords must be the same.'));
			}
		} else {
			$password = Random::generate();
		}

		return $password;
	}


	/**
	 * Reset password
	 *
	 * @param array $criteria
	 * @return UserEntity
	 * @throws RepositoryException
	 */
	public function resetPassword($criteria)
	{
		$userEntity = $this->get($criteria);

		if (!$userEntity) {
			throw new RepositoryException(_('Account with this email does not exist.'));
		}

		if ($userEntity->getStatus() == self::STATUS_BLOCKED) {
			throw new RepositoryException(_('This user account is blocked.'));
		}

        $this->onPasswordReset($userEntity);

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
		$userEntity->setPassword($password);

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


    /**
     * Get gender list
     *
     * @param int|null $gender
     *
     * @return array|string
     */
    public static function getGender($gender = null)
    {
        $list = [
            self::GENDER_WOMAN => _('Woman'),
            self::GENDER_MAN => _('Man')
        ];

        if ($gender) {
            return $list[$gender];
        }

        return $list;
    }


    /** api *******************************************************************/

    /**
     * @api {get} /user-search/ Search users
     * @param array $columns columns
     * @param string $phrase phrase
     * @param string $select select
     * @return mixed
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
     * @param array $criteria criteria
     * @param array $orderBy order
     * @param integer $limit limit
     * @param integer $offset offset
     * @return array
     */
	public function find($criteria = array(), $orderBy = array(), $limit = null, $offset = null)
    {
		return parent::find($criteria, $orderBy, $limit, $offset);
	}


    /**
     * @api {get} /user/:id Get user by id
     * @param int $id id
     * @return \Wame\Core\Entities\BaseEntity
     */
	public function getUserById($id)
    {
		return $this->get(['id' => $id]);
	}

}
