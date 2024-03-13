<?php

namespace App\Repository;

use App\Entity\RoleEntity;
use App\Entity\UserEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserEntity>
 *
 * @method UserEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserEntity[]    findAll()
 * @method UserEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserEntity::class);
    }

    public function getUsers(?int $userId): array
    {
        try {
            $queryBuilder = $this->getEntityManager()->createQueryBuilder()
                ->select('user.id, user.firstName, user.lastName, user.patronymic, user.email, user.phoneNumber')
                ->addSelect('t_role as role')
                ->from(UserEntity::class, 'user')
                ->leftJoin(RoleEntity::class, 't_role', Join::WITH, 'user.role = t_role.id');

            if (!empty($userId)) {
                $queryBuilder
                    ->where($queryBuilder->expr()->eq('user.id', ':userId'))
                    ->setParameter('userId', $userId );
            }

            return $queryBuilder->getQuery()->getArrayResult();

        } catch (\Exception $exception) {
            throw new \Exception('Не удалось получить данные');
        }
    }

}